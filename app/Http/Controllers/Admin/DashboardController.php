<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->user()->attributesToArray()['name'];
        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'name' => $name,
        ]);
    }
}
