<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserService
{
    public function get()
    {
        return User::with('roles')->orderBy('id', 'asc')->paginate(10);
    }

    public function getById($id)
    {
        return User::with('roles')->find($id);
    }

    public function getByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function insert($request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            Session::flash('success', 'Thêm User thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Thêm User lỗi');
            Log::error($error->getMessage());
            return  false;
        }

        return  true;
    }

    public function update($request, $userID)
    {
        try {
            $user = User::find($userID);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            Session::flash('success', 'Cập nhật User thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Cập nhật User lỗi');
            Log::error($error->getMessage());
            return  false;
        }

        return  true;
    }

    public function destroy($request)
    {
        try {
            User::destroy($request->id);

            Session::flash('success', 'Xóa User thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Xóa User lỗi');
            Log::error($error->getMessage());
            return  false;
        }

        return  true;
    }
}
