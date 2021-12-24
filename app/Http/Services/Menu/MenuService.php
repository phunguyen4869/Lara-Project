<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll()
    {
        //get all menu items from the database
        return Menu::orderBy('id', 'asc')->get();
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'slug' => Str::slug($request->input('name'), '-'),
                'active' => (bool) $request->input('active'),
            ]);

            Session::flash('success', 'Tạo menu thành công');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $request->input('id'))->first();

        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }
}
