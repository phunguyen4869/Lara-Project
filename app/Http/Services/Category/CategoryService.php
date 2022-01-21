<?php

namespace App\Http\Services\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CategoryService
{
    public function getParent($parent_id = 0)
    {
        return Category::where('parent_id', $parent_id)->get();
    }

    public function getAll()
    {
        //get all category items from the database
        return Category::orderBy('id', 'asc')->get();
    }

    public function show()
    {
        return Category::where('active', 1)->where('parent_id', 0)->get();
    }

    public function create($request)
    {
        try {
            Category::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'slug' => Str::slug($request->input('name'), '-'),
                'active' => (bool) $request->input('active'),
                'thumb' => (string) $request->input('thumb'),
            ]);

            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Thêm danh mục lỗi');
            Log::error($e->getMessage());
            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $category = Category::where('id', $request->input('id'))->first();

        if ($category) {
            return Category::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }

    public function update($request, $category)
    {
        try {
            //update category
            //Không cho update nếu parent_id = id
            if ($request->input('parent_id') != $category->id) {
                $category->parent_id = (int) $request->input('parent_id');
            }

            $category->name = (string) $request->input('name');
            $category->description = (string) $request->input('description');
            $category->content = (string) $request->input('content');
            $category->slug = Str::slug($request->input('name'), '-');
            $category->active = (bool) $request->input('active');
            $category->thumb = (string) $request->input('thumb');

            $category->save();

            session()->flash('success', 'Cập nhật danh mục thành công');
            return true;
        } catch (\Throwable $e) {
            session()->flash('error', $e->getMessage());
            return false;
        }
    }

    public function changeStatus($request)
    {
        $category = Category::where('id', $request->input('id'))->first();

        if ($category) {
            $category->active = $request->input('status');
            $category->save();
            return true;
        }

        return false;
    }

    public function getById($id)
    {
        return Category::where('id', $id)->orWhere('parent_id', $id)->where('active', 1)->get();
    }

    public function getCategoryName($id)
    {
        return Category::select('name')->where('id', $id)->first();
    }

    public function getProductByCategory($category, $sortBy, $minPrice, $maxPrice)
    {
        $query = $category->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);
        if (isset($sortBy)) {
            $query->orderBy('price', $sortBy);
        } else {
            $query->orderBy('id', 'asc');
        }
        if (isset($minPrice) && isset($maxPrice)) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif (isset($minPrice) && !isset($maxPrice)) {
            $query->where('price', '>=', $minPrice);
        } elseif (isset($maxPrice) && !isset($minPrice)) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query
            ->paginate(4);
    }
}
