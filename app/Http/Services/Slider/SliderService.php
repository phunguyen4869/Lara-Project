<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function get()
    {
        return Slider::orderBy('id', 'asc')->paginate(10);
    }

    public function getById($id)
    {
        return Slider::find($id);
    }

    public function show()
    {
        return Slider::select('name', 'thumb', 'url')->where('active', 1)->orderBy('sort_by', 'asc')->get();
    }

    public function insert($request)
    {
        try {
            Slider::create($request->all());

            Session::flash('success', 'Thêm slider thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Thêm slider lỗi');
            Log::error($error->getMessage());
            return  false;
        }

        return  true;
    }

    public function update($slider, $request)
    {
        try {
            $slider->fill($request->input())->save();

            Session::flash('success', 'Sửa slider thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Sửa slider không thành công');
            Log::error($error->getMessage());
            return  false;
        }
        return true;
    }

    public function delete($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();

        if ($slider) {
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }

        return false;
    }

    public function changeStatus($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();

        if ($slider) {
            $slider->active = $request->input('status');
            $slider->save();
            return true;
        }

        return false;
    }
}
