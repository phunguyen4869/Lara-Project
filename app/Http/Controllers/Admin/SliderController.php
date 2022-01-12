<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $SliderService;

    public function __construct(SliderService $SliderService)
    {
        $this->SliderService = $SliderService;
    }

    public function index()
    {
        return view('admin.slider.list', [
            'title' => 'Slider',
            'sliders' => $this->SliderService->get(),
        ]);
    }

    public function create()
    {
        return view('admin.slider.add', [
            'title' => 'Thêm slider mới',
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
        ]);

        $this->SliderService->insert($request);

        return redirect('admin/sliders/list');
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.edit', [
            'title' => 'Sửa slider',
            'slider' => $slider,
        ]);
    }

    public function update(Slider $slider, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
        ]);

        $result = $this->SliderService->update($slider, $request);

        if ($result) {
            return redirect('admin/sliders/list');
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $result = $this->SliderService->delete($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Xóa thất bại',
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        $result = $this->SliderService->changeStatus($request);

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
