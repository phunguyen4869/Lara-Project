<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductAdminService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.list', [
            'title' => 'Danh mục sản phẩm',
            'products' => $this->productService->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.add', [
            'title' => 'Thêm sản phẩm mới',
            'categories' => $this->productService->getCategory(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $result = $this->productService->insert($request);

        if ($result) {
            return redirect('admin/products/list');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Chỉnh sửa sản phẩm',
            'product' => $product,
            'categories' => $this->productService->getCategory(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProductRequest $request, Product $product)
    {
        $result = $this->productService->update($request, $product);

        if ($result) {
            return redirect('/admin/products/list');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xoá sản phẩm thành công'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Xoá sản phẩm thất bại'
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        $result = $this->productService->changeStatus($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Thay đổi trạng thái thành công'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Thay đổi trạng thái thất bại'
            ]);
        }
    }
}
