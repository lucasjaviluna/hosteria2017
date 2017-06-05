<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Logic\Image\ImageRepository;
use App\Logic\Promotion\PromotionRepository;
use App\Models\Image;
use App\Models\Promotion;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contacto;

class HomeController extends Controller
{
    protected $imageRepository;
    protected $promotionRepository;

    public function __construct(ImageRepository $imageRepository, PromotionRepository $promotionRepository)
    {
      //$this->middleware('auth');
      $this->imageRepository = $imageRepository;
      $this->promotionRepository = $promotionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Promotions
        $promotions = $this->promotionRepository->getServerPromotions(false);
        $cantPromotions = count($promotions);
        $cut = 3;
        if ($cantPromotions >= 4) {
          $cols = 6;
          $cut = 2;
        } else {
          $cols = ($cantPromotions > 0) ? 12 / $cantPromotions : 12;
        }

        //Gallery
        $images = $this->imageRepository->getServerImages(false);
        //dd($images);
        return view('app.web', compact('promotions', 'cols', 'cut', 'images'));
    }

    public function contactMsg(Request $request)
    {
      //dd($request->all());
      $name = $request->input('name');
      $sent = Mail::to('lucasjaviluna@gmail.com', 'Lucas Javier Luna')
        ->send(new Contacto($name));

      dd($sent);
    }
}
