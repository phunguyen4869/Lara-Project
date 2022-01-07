<?php

namespace App\Http\Services\Product;

use App\Models\Product;

class ProductService
{
    const LIMIT = 4;

    public function get($page = null)
    {
        return Product::with('category')
            ->where('active', 1)
            ->orderBy('id', 'asc')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        return Product::where('id', $id)
            ->where('active', 1)
            ->with('category')
            ->firstOrFail();
    }

    public function more($id, $category_id)
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->where('id', '!=', $id)
            ->where('category_id', $category_id)
            ->get();
    }
}
