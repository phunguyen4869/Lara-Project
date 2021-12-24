<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Menu\MenuService;
use App\Http\Requests\Menu\CreateFormRequest;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        return view('admin.menu.list', [
            'title' => 'Danh sách danh mục',
            'menus' => $this->menuService->getAll()
        ]);
    }

    public function create()
    {
        return view('admin.menu.create', [
            'title' => 'Thêm danh mục mới',
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $this->menuService->create($request);

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->menuService->destroy($request);

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
}
