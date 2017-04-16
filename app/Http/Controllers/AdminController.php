<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Image\ImageRepository;
use App\Logic\Promotion\PromotionRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

use App\Models\Image;
use App\Models\Promotion;

class AdminController extends Controller
{
  protected $imageRepository;
  protected $promotionRepository;

  public function __construct(ImageRepository $imageRepository, PromotionRepository $promotionRepository)
  {
    $this->imageRepository = $imageRepository;
    $this->promotionRepository = $promotionRepository;
  }

  public function index()
  {
    return view('form');
  }

  //****** Gallery functions *******
  function gallery(Request $request) {
    $images = $this->imageRepository->getServerImages();
    if ($request->ajax()) {
      return View::make('admin.galleryList', compact('images'));
    }

    return view('admin.galeria', compact('images'));
  }

  public function uploadImages(Request $request)
  {
    $input = $request->all();
    $response = $this->imageRepository->uploadMultiple($input);
    return $response;

    //$response = $this->image->upload($photo);

    // $path = public_path().'/uploads/';
    // $files = $request->file('file');
    // foreach($files as $file){
    //     $fileName = $file->getClientOriginalName();
    //     $file->move($path, $fileName);
    // }
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
  //****** End Gallery functions *******



  //****** Promotion functions *******
  public function promotion(Request $request) {
    $promotions = $this->promotionRepository->getServerPromotions();
    $id = isset($request->id) ? $request->id : 0;
    //si id > 0, es edit
    $promotion = null;
    if ($id) {
      $promotion = $this->promotionRepository->getPromotion($id);
    }

    if ($request->ajax()) {
      return View::make('admin.promotionList', compact('promotions', 'id', 'promotion'));
    }

    return view('admin.promocion', compact('promotions', 'id', 'promotion'));
  }

  public function createPromotion(Request $request) {
    $input = $request->all();
    $response = $this->promotionRepository->createPromotion($input);

    $notification = [
      'type' => 'success',
      'message' => 'New Promotion created!'
    ];
    return redirect('/admin/promociones')->with($notification);;
    //return $this->promotion($request);
    //return $response;
  }

  public function visiblePromotion(Request $request) {
    $id = $request->input('id', 0);
    $promotion = Promotion::findOrFail($id);
    $promotion->visible = !$promotion->visible;
    $promotion->save();

    return response()->json(['code' => 200, 'promotionVisible' => $promotion->visible]);
  }

  public function removePromotion(Request $request) {
    $id = $request->input('id', 0);
    $deleted = Promotion::findOrFail($id)->delete();

    return response()->json(['code' => 200, 'promotionDeleted' => $deleted]);
  }

  public function sortPromotions(Request $request) {
    $ids = $request->input('ids', []);
    $order = 1;
    foreach ($ids as $id) {
      DB::table('promotions')
            ->where('id', $id)
            ->update(['order' => $order]);
      $order++;
    }

    return response()->json(['code' => 200, 'sorted' => true]);
  }
  //****** End Promotion functions *******
}
