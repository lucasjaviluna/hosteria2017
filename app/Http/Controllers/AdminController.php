<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use App\Models\Image;

class AdminController extends Controller
{
  protected $image;

  public function __construct(ImageRepository $imageRepository)
  {
      $this->image = $imageRepository;
  }

  public function index()
  {
    return view('form');
  }

  function galeria() {
      $images = $this->getServerImages();
      return view('admin.galeria', ['images' => $images]);
  }

  public function uploadImages(Request $request)
  {
    $input = $request->all();
    $response = $this->image->uploadMultiple($input);
    return $response;

    //$response = $this->image->upload($photo);

    // $path = public_path().'/uploads/';
    // $files = $request->file('file');
    // foreach($files as $file){
    //     $fileName = $file->getClientOriginalName();
    //     $file->move($path, $fileName);
    // }


  }

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
      $images = $images->get();

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
}
