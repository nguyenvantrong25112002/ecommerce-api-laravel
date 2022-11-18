<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class DecentralizeController extends Controller
{
    public function adminPermissionAdd(Request $request)
    {
        try {
            $id_admin = $request->id_admin;
            $admin = Admin::find($id_admin);
            if ($admin) {
                $admin->syncPermissions($request->permission_id);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function adminRoleAdd(Request $request)
    {
        $id_admin = $request->id_admin;
        $role =    $request->role;
        $admin = Admin::find($id_admin);
        try {
            if ($admin) {
                $admin->syncRoles($role);
            }
        } catch (\Throwable $th) {
            echo 'Lỗi';
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::guard('admin')->user());

        // $user =   Auth::guard('admin')->user();

        // $user = Admin::find(11);
        // if ($user) {
        //     // $user->assignRole('admin');
        //     $user->syncRoles(['publisher']);
        // }





        // $role = Role::create(['name' => 'publisher']);
        // $permission = Permission::create(['name' => 'delete product']);
        // $role = Role::find(5);
        // $permission = Permission::find(3);
        // role có permission
        // $role->givePermissionTo($permission);
        // permission có role
        // $permission->assignRole($role);
        // nếu có rồi thì tâm linh thêm vào hoặc sẽ không thêm nữa
        // tương đương nhau
        // thêm hoặc cập nhập  (nhiều)  xóa tất cả chỉ thêm cái vừa xong
        // $role->syncPermissions($permission);
        // $permission->syncRoles($role);  // nếu có rồi sẽ ko thêm nữa
        // $role->revokePermissionTo($permission);
        // $permission->removeRole($role);

        die;
        return view('backend.page.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}