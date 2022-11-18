<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\Traits\TResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    use TResponse;
    public function __construct(
        public UserRepositoryInterface $userRepositoryInterface
    ) {
    }
    public function getListUser()
    {
        $datas = $this->userRepositoryInterface->getListUser();
        return view('pages.user.list', [
            'datas' => $datas
        ]);
    }

    public function getListAdmin()
    {
        $datas = $this->userRepositoryInterface->getListAdmin();
        $roles = $this->userRepositoryInterface->getAllRole();
        // dd($roles->toArray());
        // dd($datas->toArray());

        return view('pages.admin.list', [
            'datas' => $datas,
            'roles' => $roles
        ]);
    }

    public function addAdmin()
    {
        $roles = $this->userRepositoryInterface->getAllRole();
        return view('pages.admin.add-admin', [
            'roles' => $roles
        ]);
    }

    public function searchUser(Request $request)
    {
        $data = $this->userRepositoryInterface->searchUser();
        return $this->sendResponse($data);
    }

    public function addSaveAdmin(AdminRequest $request)
    {
        dd($request->all());
    }
}