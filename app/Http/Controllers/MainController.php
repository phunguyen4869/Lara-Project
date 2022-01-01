<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Product\ProductService;

class MainController extends Controller
{
    protected $sliders;
    protected $categories;
    protected $products;

    public function __construct(SliderService $sliderService, ProductService $products)
    {
        $this->sliders = $sliderService;
        $this->products = $products;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Trang chủ',
            'sliders' => $this->sliders->show(),
            'products' => $this->products->get(),
        ]);
    }
}
