<?php

namespace App\Logic\Promotion;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use App\Models\Promotion;

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
    foreach ($promotions as $image) {
        $promotionAnswer[] = [
          'id' => $image->id,
          'type' => $image->type,
          'title' => $image->title,
          'subtitle' => $image->subtitle,
          'visible' => $image->visible,
          'info' => $image->info
        ];
    }

    return $promotionAnswer;
  }
}
