<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Product\ProductService;

class MainController extends Controller
{
    protected $sliders;
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

    public function showProductModal(Request $request)
    {
        $product = $this->products->show($request->id);

        $product->price = number_format($product->price);
        $product->price_sale = number_format($product->price_sale);

        if (!empty($product)) {
            return response()->json([
                'error' => false,
                'data' => $product,
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function showProductDetail($id = '', $slug = '')
    {
        $product = $this->products->show($id);
        $productsMore = $this->products->more($id, $product->category_id);

        $product->price = number_format($product->price);
        $product->price_sale = number_format($product->price_sale);

        $product->thumb = explode(',', $product->thumb);

        return view('products.detail', [
            'title' => $product->name,
            'product' => $product,
            'productsMore' => $productsMore,
        ]);
    }

    public function loadMore(Request $request)
    {
        $products = $this->products->get($request->page);

        if (count($products) != 0) {
            $html = view('products.list', [
                'products' => $products,
            ])->render();

            return response()->json([
                'html' => $html,
            ]);
        }

        return response()->json([
            'html' => '',
        ]);
    }
}
