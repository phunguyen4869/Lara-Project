<?php

namespace App\Http\Services;

class UploadService
{
    public function store($request)
    {
        try {
            //Kiểm tra file có tồn tại hay không
            if ($request->hasFile('file')) {

                //Lấy tên gốc của file
                $name = $request->file('file')->getClientOriginalName();

                //Tạo tên thư mục chứa file
                $path = 'uploads/' . date("Y/m/d");

                //Lưu trữ file vào thư mục storage/app/uploads với tên là $name
                $request->file('file')->storeAs(
                    'public/' . $path,
                    $name
                );

                return '/storage/' . $path . '/' . $name;
            }
        } catch (\Exception $error) {
            return false;
        }
    }
}
