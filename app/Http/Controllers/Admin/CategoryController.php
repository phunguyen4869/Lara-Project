<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateFormRequest;
use App\Http\Services\Category\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.category.list', [
            'title' => 'Danh sách danh mục',
            'categories' => $this->categoryService->getAll()
        ]);
    }

    public function create()
    {
        return view('admin.category.create', [
            'title' => 'Thêm danh mục mới',
            'categories' => $this->categoryService->getAll()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result = $this->categoryService->create($request);

        if ($result) {
            return redirect('/admin/categories/list');
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $result = $this->categoryService->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa danh mục thành công'
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function edit(Category $category) //check category id is exist in database
    {

        return view('admin.category.edit', [
            'title' => 'Sửa danh mục ' . $category->name,
            'category' => $category,
            'categories' => $this->categoryService->getAll()
        ]);
    }

    public function update(CreateFormRequest $request, Category $category)
    {
        $this->categoryService->update($request, $category);

        return redirect('/admin/categories/list');
    }

    public function changeStatus(Request $request)
    {
        $result = $this->categoryService->changeStatus($request);

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
