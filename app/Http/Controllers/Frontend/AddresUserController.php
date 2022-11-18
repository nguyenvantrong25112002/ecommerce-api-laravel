<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address\CityProvinces;
use App\Models\Address\District;
use App\Models\Address\Ward;
use App\Models\AddresUser;
use Illuminate\Http\Request;

class AddresUserController extends Controller
{
    protected $user;
    protected $addresUserModel;
    protected $cityProvincesModel;
    protected $districtModel;
    protected $wardModel;
    public function __construct(
        AddresUser $addresUser,
        CityProvinces $cityProvinces,
        District $district,
        Ward $ward
    ) {
        $this->user = auth('sanctum')->user();
        $this->addresUserModel = $addresUser;
        $this->cityProvincesModel = $cityProvinces;
        $this->districtModel = $district;
        $this->wardModel = $ward;
    }
    public function index()
    {
        $user_id = auth('sanctum')->user()->id;
        $data =  $this->addresUserModel::where('user_id', $user_id)->get();
        return response()->json([
            'status' => true,
            'payload' => $data,
        ]);
    }
    public function store(Request $request)
    {
        $status = 0;
        $addresUser =  $this->addresUserModel::where('user_id', $this->user->id)->get();
        if (count($addresUser) == 0) {
            $status = 1;
        } else {
            if ($request->status == true) {
                $this->addresUserModel::where('user_id', $this->user->id)->where('status', config('util.ACTIVE_STATUS'))
                    ->update([
                        'status' => config('util.INACTIVE_STATUS')
                    ]);
                $status = 1;
            }
        }

        try {
            $this->addresUserModel::create([
                'user_id' => $this->user->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'city_province' => $this->cityProvincesModel::find($request->city_province)->name,
                'district' => $this->districtModel::find($request->district)->name,
                'ward' =>  $this->wardModel::find($request->ward)->name,
                'detailed_address' => $request->detailed_address,
                'status' =>  $status,
            ]);
            return response()->json([
                'status' => true,
                'payload' => 'Thêm địa chỉ đơn hàng thành công !!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'payload' => 'Có lỗi , vui lòng liên hệ quản trị viên !!',
            ]);
        }
    }
    public function updateActiveDefault(Request $request)
    {
        try {
            $this->addresUserModel::where('user_id', $this->user->id)->where('status', config('util.ACTIVE_STATUS'))
                ->update([
                    'status' => config('util.INACTIVE_STATUS')
                ]);
            $this->addresUserModel::find($request->id)->update([
                'status' => config('util.ACTIVE_STATUS')
            ]);
            return response()->json([
                'status' => true,
                'payload' => 'Đặt mặc định thành công !!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'payload' => 'Có lỗi , vui lòng liên hệ quản trị viên !!',
            ]);
        }
    }
}