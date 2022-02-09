<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Services\Roles\RolesService;
use App\Http\Services\User\UserService;

class UserController extends Controller
{
    protected $user;
    protected $roles;

    public function __construct(UserService $user, RolesService $roles)
    {
        $this->user = $user;
        $this->roles = $roles;
    }

    public function index()
    {
        $users = $this->user->get();

        return view('admin.users.list', [
            'title' => 'Users list',
            'users' => $users,
        ]);
    }

    public function rolesList()
    {
        $roles = $this->roles->get();

        return view('admin.users.roles.list', [
            'title' => 'Roles list',
            'roles' => $roles,
        ]);
    }

    public function roleCreate()
    {
        return view('admin.users.roles.add', [
            'title' => 'Create role',
        ]);
    }

    public function roleStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);

        $result = Role::create(['name' => $request->name]);

        if ($result) {
            return redirect('admin/user/roles/list');
        } else {
            return redirect()->back();
        }
    }

    public function roleEdit($id)
    {
        $role = $this->roles->getRoleById($id);
        $allPermissions = $this->roles->getPermissions();

        return view('admin.users.roles.edit', [
            'title' => 'Edit role',
            'role' => $role,
            'allPermissions' => $allPermissions,
        ]);
    }

    public function roleUpdate(Request $request)
    {
        $result = $this->roles->roleUpdate($request);

        if ($result) {
            return redirect('admin/user/roles/list');
        } else {
            return redirect()->back();
        }
    }

    public function roleDestroy(Request $request)
    {
        $result = $this->roles->removeRole($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa role thành công'
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function create()
    {
        $roles = Role::all()->pluck('name');

        return view('admin.users.add', [
            'title' => 'Thêm user mới',
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required',
            're_password' => 'required|same:password',
        ]);

        $result = $this->user->insert($request);

        if ($result) {
            $user = $this->user->getByEmail($request->email);
            $user->assignRole($request->role);

            event(new Registered($user));

            return redirect('admin/user/list');
        } else {
            return redirect()->back();
        }
    }

    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name');
        return view('admin.users.edit', [
            'title' => 'Sửa user',
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => 'required|email:filter|unique:users,email,' . $user->id,
            'password' => 'nullable',
            're_password' => 'same:password',
        ]);

        $result = $this->user->update($request, $user->id);

        if ($result) {
            if ($user->id != 1) {
                $user->syncRoles($request->role);
            }

            return redirect('admin/user/list');
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $result = $this->user->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa user thành công'
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function paymentList()
    {
        $users = $this->user->getPaymentMethod();

        return view('admin.users.payment.list', [
            'title' => 'Payment list',
            'users' => $users,
        ]);
    }

    public function paymentEdit(User $user)
    {
        return view('admin.users.payment.edit', [
            'title' => 'Edit payment',
            'user' => $user,
        ]);
    }

    public function paymentUpdate(Request $request, User $user)
    {
        if ($request->payment_method == 'credit_card') {
            $this->validate($request, [
                'credit_card_number' => 'required',
                'expiration_date' => 'required',
                'cvv_code' => 'required|integer',
                'credit_card_name' => 'required',
            ]);
        } elseif ($request->payment_method == 'atm_card') {
            $this->validate($request, [
                'atm_card_number' => 'required',
                'bank_name' => 'required',
                'atm_card_name' => 'required',
            ]);
        }

        $result = $this->user->updatePaymentMethod($request, $user);

        if ($result) {
            return redirect('admin/user/payment/list');
        } else {
            return redirect()->back();
        }
    }

    public function paymentDestroy(Request $request)
    {
        $result = $this->user->destroyPaymentMethod($request->id);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa payment method thành công. User sẽ thanh toán mặc định qua phương thức COD'
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }
}
