<?php


namespace App\Http\Services\Product;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function getCategory()
    {
        return Category::where('active', 1)->get();
    }

    protected function isValidPrice($request)
    {
        if (
            $request->input('price') != 0 && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price')
        ) {
            Session::flash('error', 'Giá khuyến mại phải nhỏ hơn giá gốc');
            return false;
        }

        if ($request->input('price_sale') != 0 && (int)$request->input('price') == 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }

        return  true;
    }

    public function insert($request)
    {
        // Check price is valid
        $isValidPrice = $this->isValidPrice($request);

        if ($isValidPrice === false) return false;

        try {
            //Except the _token param
            $request->except('_token');

            Product::create($request->all());

            Session::flash('success', 'Thêm Sản phẩm thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Thêm Sản phẩm lỗi');
            Log::error($error->getMessage());
            return  false;
        }

        return  true;
    }

    public function get()
    {
        return Product::with('category')
            ->orderBy('id', 'asc')->paginate(10);
    }

    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $product->fill($request->input());
            $product->save();

            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            Log::error($error->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        // Check product is exist
        $product = Product::where('id', $request->input('id'))->first();

        if ($product) {
            $product->delete();
            return true;
        }

        return false;
    }

    public function changeStatus($request)
    {
        $product = Product::where('id', $request->input('id'))->first();

        if ($product) {
            $product->active = $request->input('status');
            $product->save();
            return true;
        }

        return false;
    }
}
