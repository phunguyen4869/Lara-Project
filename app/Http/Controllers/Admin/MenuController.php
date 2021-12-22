<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function create()
    {
        return view('admin.menu.create', [
            'title' => 'Create New Menu'
        ]);
    }
}
