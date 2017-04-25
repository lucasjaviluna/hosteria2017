<?php

namespace App\Logic\Promotion;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use App\Models\Promotion;
use App\Logic\Image\ImageRepository;

class PromotionRepository
{
  public function getServerPromotions($all = true)
  {
    $promotions = Promotion::whereNull('deleted_at');
    if (!$all) {
      $promotions->where('visible', true);
    }
    $promotions = $promotions->orderBy('order', 'asc')->get();

    $promotionAnswer = [];
    foreach ($promotions as $promotion) {
        $info = $promotion->info;
        //if ($promotion->type === Promotion::TYPE_LIST) {
          $info = preg_split("/\r\n/", $info);
        //}

        $promotionAnswer[] = [
          'id' => $promotion->id,
          'type' => $promotion->type,
          'title' => $promotion->title,
          'subtitle' => $promotion->subtitle,
          'important' => $promotion->important,
          'visible' => $promotion->visible,
          'info' => $info,
          'image' => empty($promotion->image) ? null : $promotion->image
        ];
    }

//dd($promotionAnswer);
    return $promotionAnswer;
  }

  public function createPromotion($form_data) {
    $type = $form_data['type'];
    $title = $form_data['title'];
    //$subtitle = $form_data['subtitle'];
    $info = $form_data['info'];
    $important = $form_data['important'];

    $id = DB::table('promotions')->whereNull('deleted_at')->max('id');
    $id++;
    $order = $id;
//dd($form_data);
    $fileName = null;
    $path = public_path().'/promotions/';
    if (isset($form_data['image'])) {
      $file = $form_data['image'];
      $extension = $file->getClientOriginalExtension();
      $fileName = sprintf('%d.%s', $id, $extension);
      $imageRepository = new ImageRepository();
      $imageRepository->original($file, $fileName, 2);
      $imageRepository->icon($file, $fileName, 2);
      //$file->move($path, $fileName);
    }

    $promotion = new Promotion();
    $promotion->type = $type;
    $promotion->title = $title;
    //$promotion->subtitle = $subtitle;
    $promotion->important = $important;
    $promotion->image = $fileName;
    $promotion->info = $info;
    $promotion->order = $order;
    $promotion->save();

    return Response::json([
        'error' => false,
        'code'  => 200
    ], 200);
  }

  public function getPromotion($id)
  {
    $promotion = Promotion::whereNull('deleted_at')->where('visible', true)->where('id', $id)->first();

    if (empty($promotion)) return null;

    $promotionAnswer = [
      'id' => $promotion->id,
      'type' => $promotion->type,
      'title' => $promotion->title,
      'subtitle' => $promotion->subtitle,
      'important' => $promotion->important,
      'visible' => $promotion->visible,
      'info' => preg_split("/\r\n/", $promotion->info),
      'image' => $promotion->image
    ];

    return $promotionAnswer;
  }
}
