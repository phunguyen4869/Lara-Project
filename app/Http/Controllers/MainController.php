<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;

class MainController extends Controller
{
    protected $sliders;
    protected $categories;

    public function __construct(SliderService $sliderService)
    {
        $this->sliders = $sliderService;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Trang chủ',
            'sliders' => $this->sliders->show(),
        ]);
    }
}
