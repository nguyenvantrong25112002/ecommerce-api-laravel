<?php

namespace App\Http\Controllers\Frontend;

use App\Models\AddresUser;
use App\Models\Address\Ward;
use Illuminate\Http\Request;
use App\Models\Address\District;
use App\Models\Address\Provinces;
use App\Services\Traits\TResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundApiException;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\AddresUserRepositoryInterface;
use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Repositories\Interfaces\ProvincesRepositoryInterface;
use App\Repositories\Interfaces\WardRepositoryInterface;

class AddresUserController extends Controller
{
    use TResponse;
    protected $user;
    protected $addresUserModel;
    protected $cityProvincesModel;
    protected $districtModel;
    protected $wardModel;
    public function __construct(
        private DB $dB,
        AddresUser $addresUser,
        Provinces $cityProvinces,
        District $district,
        Ward $ward,
        private AddresUserRepositoryInterface $addresUserRepositoryInterface,
        private UserRepositoryInterface $userRepositoryInterface,
        private WardRepositoryInterface $wardRepositoryInterface,
        private DistrictRepositoryInterface $districtRepositoryInterface,
        private ProvincesRepositoryInterface $provincesRepositoryInterface
    ) {
        $this->user = auth('sanctum')->user();
        $this->addresUserModel = $addresUser;
        $this->cityProvincesModel = $cityProvinces;
        $this->districtModel = $district;
        $this->wardModel = $ward;
    }
    public function index()
    {
        $user_id = $this->userRepositoryInterface->getAuthSanctum()->id;
        $datas =  $this->addresUserRepositoryInterface->getAddresFromUser($user_id);
        if (count($datas) == 0)  return $this->sendResponseNull();
        return $this->sendResponse($datas, trans('message.success'));
    }

    public function store(Request $request)
    {
        $this->dB::beginTransaction();
        try {
            $status = config('util.INACTIVE_STATUS');
            $user_id = $this->userRepositoryInterface->getAuthSanctum()->id;
            $addresUser  = $this->addresUserRepositoryInterface->getAddresFromUser($user_id);
            if (count($addresUser) == 0) {
                $status = config('util.ACTIVE_STATUS');
            } else {
                if ($request->status == true) {
                    $this->addresUserRepositoryInterface->update([
                        'user_id' =>  $user_id,
                        'status' => config('util.ACTIVE_STATUS')
                    ], [
                        'status' => config('util.INACTIVE_STATUS')
                    ]);
                    $status = config('util.ACTIVE_STATUS');
                }
            }
            $this->addresUserRepositoryInterface->create([
                'user_id' =>   $user_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'city_province' => $this->provincesRepositoryInterface->find($request->city_province)->full_name,
                'district' => $this->districtRepositoryInterface->find($request->district)->full_name,
                'ward' =>  $this->wardRepositoryInterface->find($request->ward)->full_name,
                'detailed_address' => $request->detailed_address,
                'status' =>  $status,
            ]);
            $this->dB::commit();
            return $this->sendResponse(null, trans('message.success'));
        } catch (\Throwable $th) {
            $this->dB::rollBack();
            return $this->sendResponseError(trans('message.error'), 500);
        }
    }
    public function updateActiveDefault(Request $request)
    {
        $user_id = $this->userRepositoryInterface->getAuthSanctum()->id;
        $this->dB::beginTransaction();
        try {
            $this->addresUserRepositoryInterface->update([
                'user_id' =>  $user_id,
                'status' => config('util.ACTIVE_STATUS')
            ], [
                'status' => config('util.INACTIVE_STATUS')
            ]);
            $this->addresUserRepositoryInterface->updateById([
                'status' => config('util.ACTIVE_STATUS')
            ], $request->id);
            $this->dB::commit();
            return $this->sendResponse(null, 'Đặt mặc định thành công !!');
        } catch (\Throwable $th) {
            $this->dB::rollBack();
            return $this->sendResponseError(trans('message.error'), 500);
        }
    }

    public function delete($id)
    {
        $data =  $this->addresUserRepositoryInterface->find($id);
        if (!$data) throw new NotFoundApiException();
        $data->delete();
        return $this->sendResponse($data, trans('message.success'));
    }
}