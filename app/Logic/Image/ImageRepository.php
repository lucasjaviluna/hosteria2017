<?php

namespace App\Logic\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use App\Models\Image;


class ImageRepository
{
    public function getServerImages($all = true)
    {
        //$images = Image::get(['original_name', 'filename']);
        //$images = Image::all();
        //Image::find(2)->delete();

        // $images = Image::where('visible', $visible)
        //           ->whereNull('deleted_at')
        //           ->get();
        $images = Image::whereNull('deleted_at');
        if (!$all) {
          $images->where('visible', true);
        }
        $images = $images->orderBy('order', 'asc')->get();

        $imageAnswer = [];
        $pathFull = Config::get('images.full_size');
        $pathIcon = Config::get('images.icon_size');
        foreach ($images as $image) {
            $imageAnswer[] = [
              'id' => $image->id,
              'filename' => $image->filename,
              'original' => $image->original_name,
              'pathIcon' => $pathIcon . $image->filename,
              'pathFull' => $pathFull . $image->filename,
              'visible' => $image->visible,
              'size' => File::size($pathFull . $image->filename)
            ];
        }

        return $imageAnswer;
        // return response()->json([
        //     'images' => $imageAnswer
        // ]);
        //return response()->json($imageAnswer);
    }

    public function uploadMultiple( $form_data )
    {
        $validator = Validator::make($form_data, Image::$rules, Image::$messages);

        if ($validator->fails()) {

            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        }

        $photos = $form_data['file'];
        //@TODO: traer sólo los visibles y no borrados y sacar el máximo id
        $id = DB::table('images')->whereNull('deleted_at')->max('id');
        $order = $id;
        foreach ($photos as $photo) {
          $id++;
          $order++;
          $originalName = $photo->getClientOriginalName();
          $extension = $photo->getClientOriginalExtension();
          $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

          $filename = $this->sanitize($originalNameWithoutExt);
          //$allowed_filename = $this->createUniqueFilename( $filename, $extension );

          $allowed_filename = sprintf('%d.%s', $id, $extension);
          $uploadSuccess1 = $this->original( $photo, $allowed_filename );

          $uploadSuccess2 = $this->icon( $photo, $allowed_filename );

          if( !$uploadSuccess1 || !$uploadSuccess2 ) {

              return Response::json([
                  'error' => true,
                  'message' => 'Server error while uploading',
                  'code' => 500
              ], 500);

          }

          $sessionImage = new Image;
          $sessionImage->filename      = $allowed_filename;
          $sessionImage->original_name = $originalName;
          $sessionImage->order = $order;
          $sessionImage->save();
        }

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);

    }

    public function createUniqueFilename( $filename, $extension )
    {
        $full_size_dir = Config::get('images.full_size');
        $full_image_path = $full_size_dir . $filename . '.' . $extension;
        if ( File::exists( $full_image_path ) )
        {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken . '.' . $extension;
        }

        return $filename . '.' . $extension;
    }

    /**
     * Optimize Original Image
     */
    public function original( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->save(Config::get('images.full_size') . $filename );

        return $image;
    }

    /**
     * Create Icon From Original
     */
    public function icon( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
            })
            ->save( Config::get('images.icon_size')  . $filename );

        return $image;
    }

    /**
     * Delete Image From Session folder, based on original filename
     */
    public function delete( $originalFilename)
    {

        $full_size_dir = Config::get('images.full_size');
        $icon_size_dir = Config::get('images.icon_size');

        $sessionImage = Image::where('original_name', 'like', $originalFilename)->first();


        if(empty($sessionImage))
        {
            return Response::json([
                'error' => true,
                'code'  => 400
            ], 400);

        }

        $full_path1 = $full_size_dir . $sessionImage->filename;
        $full_path2 = $icon_size_dir . $sessionImage->filename;

        if ( File::exists( $full_path1 ) )
        {
            File::delete( $full_path1 );
        }

        if ( File::exists( $full_path2 ) )
        {
            File::delete( $full_path2 );
        }

        if( !empty($sessionImage))
        {
            $sessionImage->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);
    }

    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}