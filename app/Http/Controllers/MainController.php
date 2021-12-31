<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Category\CategoryService;

class MainController extends Controller
{
    protected $sliders;
    protected $categories;

    public function __construct(SliderService $sliderService, CategoryService $categoryService)
    {
        $this->sliders = $sliderService;
        $this->categories = $categoryService;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Trang chủ',
            'sliders' => $this->sliders->show(),
            'categories' => $this->categories->show(),
        ]);
    }
}
