<?php

namespace App\Http\Services;

class UploadService
{
    public function store($request)
    {
        try {
            //Kiểm tra file có tồn tại hay không
            if ($request->hasFile('files')) {
                //Tạo tên thư mục chứa file theo ngày
                $path = 'uploads/' . date("Y/m/d");

                //Lấy tên gốc của các file
                $fileCount = count($request->file('files'));
                for ($i = 0; $i < $fileCount; $i++) {
                    $name[] = $request
                        ->file('files')[$i]
                        ->getClientOriginalName();

                    //Lưu file vào thư mục
                    $request->file('files')[$i]->storeAs(
                        'public/' . $path,
                        $name[$i]
                    );
                    $url[] = '/storage/' . $path . '/' . $name[$i];
                }
                return $url;
            }
        } catch (\Exception $error) {
            return false;
        }
    }
}
