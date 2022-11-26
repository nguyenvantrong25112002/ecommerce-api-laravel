<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\NotFoundApiException;
use Illuminate\Http\Request;
use App\Services\Traits\TResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    use TResponse;
    public function __construct(
        public UserRepositoryInterface $userRepositoryInterface
    ) {
    }

    public function authUser()
    {
        return auth()->user();
    }

    public function validatorMake()
    {
        $v = Validator::make([], []);
        return $v;
    }

    /** 
     * Lấy ra danh sách người dùng không có quyền
     */
    public function getListUser()
    {
        $datas = $this->userRepositoryInterface->getListUser();
        return view('pages.user.list', [
            'datas' => $datas
        ]);
    }

    /**
     * Lấy ra danh sách admin có quyền
     */
    public function getListAdmin()
    {
        $datas = $this->userRepositoryInterface->getListAdmin();
        $roles = $this->userRepositoryInterface->getAllRole();
        return view('pages.admin.list', [
            'datas' => $datas,
            'roles' => $roles
        ]);
    }

    /**
     * Get ra form add admin
     * */
    public function addAdmin()
    {
        $roles = $this->userRepositoryInterface->getAllRole();
        return view('pages.admin.add-admin', [
            'roles' => $roles
        ]);
    }

    /**
     * Tìm kiếm ra 1 user không có quyền 
     */
    public function searchUser(Request $request)
    {
        $data = $this->userRepositoryInterface->whereUserNotRoleFirst($request->information, $request->information);
        return $this->sendResponse($data);
    }

    /**
     * Lưu admin mới
     * */
    public function addSaveAdmin(AdminRequest $request, DB $dB)
    {
        $dB::beginTransaction();
        try {
            $role = array($request->role);
            if ($request->user == 'old') {
                $data = $this->userRepositoryInterface->whereUserNotRoleFirst($request->information);
                if (!$data) return abort(500);
                $data->syncRoles($role);
            } else if ($request->user == 'new') {
                $validator =  $this->validatorMake();
                $checkUserEmail = $this->userRepositoryInterface->whereEmailFirst($request->email);
                $checkUserPhone = $this->userRepositoryInterface->wherePhoneFirst($request->phone_number);
                if ($checkUserEmail) {
                    $validator->getMessageBag()->add('email', 'Email này đã tồn tại trên hệ thống.');
                    $checkUserEmailRole = $this->userRepositoryInterface->whereUserNotRoleFirst($request->email);
                    if (!$checkUserEmailRole)  $validator->getMessageBag()->add('email', 'Email này không có quyền truy cập.');
                }
                if ($checkUserPhone) {
                    $validator->getMessageBag()->add('phone_number', 'Số điện thoại này đã tồn tại trên hệ thống.');
                    $checkUserPhoneRole = $this->userRepositoryInterface->whereUserNotRoleFirst(null, $request->phone_number);
                    if (!$checkUserPhoneRole)  $validator->getMessageBag()->add('phone_number', 'Số điện thoại này không có quyền truy cập.');
                }
                if (count($validator->messages()->all())) throw new ValidationException($validator);
                $this->userRepositoryInterface->create($request->all())->syncRoles($role);
            } else {
                return abort(500);
            }
            $dB::commit();
            return redirect()->route('admin.personnel.list')->with(config('util.SUCCESS'), trans('message.create_success'));
        } catch (\Throwable $th) {
            $dB::rollback();
            return abort(500);
        }
    }

    /**
     * Chỉnh sửa quyền từ danh sách admin
     */
    public function editRoleAdmin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role_id' => 'required|numeric',
                'user_id' => 'required|numeric',
            ]
        );
        if ($validator->fails()) return $this->sendResponseError('Lỗi validation', 400, $validator->errors());
        if ($this->authUser()->id == $request->user_id) return $this->sendResponseError(trans('message.error'), 500);
        $user = $this->userRepositoryInterface->find($request->user_id);
        if ($request->role_id == 0) {
            $user->syncRoles([]);
        } else {
            $role = $this->userRepositoryInterface->findRole($request->role_id);
            if (is_null($user) || is_null($role))  throw new NotFoundApiException();
            $user->syncRoles(array($role->name));
        }
        return $this->sendResponse(null, trans('message.update_success'));
    }
}