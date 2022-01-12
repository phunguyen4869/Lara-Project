<?php

namespace App\Http\Services\Roles;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RolesService
{
    public function get()
    {
        return Role::with('permissions')->get();
    }

    public function getRoleById($id)
    {
        return Role::with('permissions')->find($id);
    }

    public function roleUpdate($request)
    {
        try {
            $role = $this->getRoleById($request->roleId);
            $role->name = $request->name;
            $role->syncPermissions($request->permissions);
            $role->save();

            Session::flash('success', 'Sửa thông tin role thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Sửa thông tin role không thành công');
            Log::error($error->getMessage());
            return  false;
        }
        return true;
    }

    public function removeRole($request)
    {
        try {
            $role = $this->getRoleById($request->id);
            $role->delete();

            Session::flash('success', 'Xóa role thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Xóa role không thành công');
            Log::error($error->getMessage());
            return  false;
        }
        return true;
    }

    public function getPermissions()
    {
        return Permission::all();
    }

    public function getPermissionById($id)
    {
        return Permission::find($id);
    }

    public function removePermission($role, $permission)
    {
        return $role->revokePermissionTo($permission);
    }
}
