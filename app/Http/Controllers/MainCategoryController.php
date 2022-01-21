<?php

namespace App\Http\Controllers;

use App\Http\Services\Category\CategoryService;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryService $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        // $categories = $this->category->getById($request->id);

        // $categoryName = $this->category->getCategoryName($request->id);

        // $sortBy = $request->price;
        // (isset($request->minPrice)) ? $minPrice = $request->minPrice : $minPrice = null;
        // (isset($request->maxPrice)) ? $maxPrice = $request->maxPrice : $maxPrice = null;

        // foreach ($categories as $value) {
        //     $products[] = $this->category->getProductByCategory($value, $sortBy, $minPrice, $maxPrice);
        // }

        $categories = $this->category->getById($request->id);

        $categoryName = $this->category->getCategoryName($request->id);

        $sortBy = $request->price;
        (isset($request->minPrice)) ? $minPrice = $request->minPrice : $minPrice = null;
        (isset($request->maxPrice)) ? $maxPrice = $request->maxPrice : $maxPrice = null;

        if (count($categories) > 1) {
            unset($categories[0]);
        }

        foreach ($categories as $value) {
            $childCategory = $this->category->getParent($value->id);
            //dd($childCategory);
            if (!empty($childCategory->all())) {
                $childCategory = $this->category->getParent($value->id);
                foreach ($childCategory as $value) {
                    $products[] = $this->category->getProductByCategory($value, $sortBy, $minPrice, $maxPrice);
                }
            } else {
                $products[] = $this->category->getProductByCategory($value, $sortBy, $minPrice, $maxPrice);
                //dd($childCategory);
            }
            //$products[] = $this->category->getProductByCategory($value, $sortBy, $minPrice, $maxPrice);
        }

        return view('category', [
            'title' => $categoryName->name,
            'products' => $products,
        ]);
    }
}
