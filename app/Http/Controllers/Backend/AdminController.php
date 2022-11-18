<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Permission;
use App\Models\User; //sử dụng model User
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function adminLogin()
    {
        return view('auth.login-admin');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function adminGoogleCallback()
    {
        $ggUser = Socialite::driver('google')->user()->user;

        $user = User::where(function ($q) use ($ggUser) {
            $q->where('email', $ggUser['email']);
            $q->where('status', config('util.ACTIVE_STATUS'));
            return $q;
        })->first();
        // $user = User::where([
        //     ['email', $ggUser['email']],
        //     ['status', config('util.ACTIVE_STATUS')]
        // ])->first();
        // 
        // dd($user->hasRole([
        //     config('util.ROLE_SUPER_ADMIN'),
        //     config('util.ROLE_ADMIN'),
        //     config('util.ROLE_STAFF'),
        //     config('util.ROLE_USER'),
        // ]));
        if ($user && $user->hasRole([
            config('util.ROLE_SUPER_ADMIN'),
            config('util.ROLE_ADMIN'),
            config('util.ROLE_STAFF')
        ])) {
            auth()->login($user);
            // if (!session()->has('token')) {
            //     auth()->user()->tokens()->delete();
            //     $token = auth()->user()->createToken("token_admin")->plainTextToken;
            //     session()->put('token', $token);
            // }
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('login')->with(config('util.ERROR'), "Tài khoản của bạn không có quyền truy cập!");
    }

    public function logout()
    {
        // Auth::logout();
        auth()->logout();
        return redirect()->route('login');
    }



    public function decentralize($id_admin)
    {
        // $admin = Admin::find($id_admin);
        // dd($admin);
        // dd(Auth::guard('admin')->user()->toArray());
        $user = Auth::guard('admin')->user();

        dd($user->roles()->get());
        // dd($user->hasRole(Role::findById(5)));
    }
    public function get_role(Request $request)
    {
        $id_admin = $request->id_admin;
        try {
            $roles = Role::all();
            $user =  Admin::find($id_admin);
            if ($user) {
                $roles_admin = $user->roles()->first();
                return view('backend.page.admin.include.list_role', compact('roles_admin', 'roles', 'id_admin'));
            }
        } catch (\Throwable $th) {
            echo 'Lỗi không tải được vai trò';
        }
    }
    public function get_permission(Request $request)
    {
        $id_admin = $request->id_admin;
        try {
            $permissions = Permission::all();
            $user =  Admin::find($id_admin);
            if ($user) {
                $name_roles = $user->roles()->get();
                $permissions_via_role = $user->getAllPermissions();
            }
            return view(
                'backend.page.admin.include.list_permission',
                compact('id_admin', 'permissions', 'permissions_via_role', 'name_roles')
            );
        } catch (\Throwable $th) {
            echo 'Lỗi không tải được nhánh quyền';
        }
    }
    public function impersonate_role($id_admin)
    {

        $admin = Admin::find($id_admin);
        if ($admin) {
            Session::put('impersonate', $admin->id_admin);
        }
        return Redirect::route('admin.dashboard');
    }
}