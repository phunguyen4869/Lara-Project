<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.users.register', [
            'title' => 'Register',
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //check email and password is valid
            'email' => 'required|email:filter|unique:users,email',
            'password' => 'required',
            're_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('member');

        event(new Registered($user));

        return redirect()->route('login');
    }
}
