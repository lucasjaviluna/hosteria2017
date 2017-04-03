<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

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

  function galeria(Request $request) {
    $images = $this->getServerImages();
    if ($request->ajax()) {
      return View::make('admin.refreshGallery', compact('images'));
    }

    return view('admin.galeria', compact('images'));
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

  public function visibleImage(Request $request) {
    $id = $request->input('id', 0);
    $image = Image::findOrFail($id);
    $image->visible = !$image->visible;
    $image->save();

    return response()->json(['code' => 200, 'imageVisible' => $image->visible]);
  }

  public function removeImage(Request $request) {
    $id = $request->input('id', 0);
    $deleted = Image::findOrFail($id)->delete();

    return response()->json(['code' => 200, 'imageDeleted' => $deleted]);
  }

  public function sortImages(Request $request) {
    $ids = $request->input('ids', []);
    $order = 1;
    foreach ($ids as $id) {
      DB::table('images')
            ->where('id', $id)
            ->update(['order' => $order]);
      $order++;
    }

    return response()->json(['code' => 200, 'sorted' => true]);
  }
}
