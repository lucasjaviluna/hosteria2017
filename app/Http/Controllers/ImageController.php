<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use App\Models\Image;

class ImageController extends Controller
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

  public function store(Request $request)
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

  public function getServerImages()
  {
      //$images = Image::get(['original_name', 'filename']);
      //$images = Image::all();
      //Image::find(2)->delete();
      $images = Image::where('visible', 1)
                ->whereNull('deleted_at')
                ->get();

      $imageAnswer = [];
      $pathFull = Config::get('images.gallery_full_size');
      $pathIcon = Config::get('images.gallery_icon_size');
      foreach ($images as $image) {
          $imageAnswer[] = [
              'id' => $image->id,
              'original' => $image->original_name,
              'pathIcon' => $pathIcon . $image->filename,
              'pathFull' => $pathFull . $image->filename,
              'visible' => $image->visible,
              'size' => File::size($pathFull . $image->filename)
          ];
      }

      return response()->json([
          'images' => $imageAnswer
      ]);
  }
}
