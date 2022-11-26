<?php

namespace App\Http\Controllers;

use App\Models\Address\Ward;
use Illuminate\Http\Request;
use App\Models\Address\District;
use App\Models\Address\Provinces;
use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Repositories\Interfaces\ProvincesRepositoryInterface;
use App\Repositories\Interfaces\WardRepositoryInterface;
use App\Services\Traits\TResponse;

class AddressController extends Controller
{
    use TResponse;
    protected $cityProvincesModel;
    protected $districtModel;
    protected $wardModel;
    public function __construct(
        Provinces $cityProvinces,
        District $district,
        Ward $ward,
        private ProvincesRepositoryInterface $provincesRepositoryInterface,
        private DistrictRepositoryInterface $districtRepositoryInterface,
        private WardRepositoryInterface $wardRepositoryInterface

    ) {
        $this->cityProvincesModel = $cityProvinces;
        $this->districtModel = $district;
        $this->wardModel = $ward;
    }

    public function cityProvincesGet()
    {
        $datas = $this->provincesRepositoryInterface->getAll();
        return $this->sendResponse($datas, trans('message.success'));
    }

    public function getDistrict(Request $request)
    {
        $datas = $this->districtRepositoryInterface->getDistrictFromProvinces($request->code);
        return $this->sendResponse($datas, trans('message.success'));
    }
    public function getWard(Request $request)
    {
        $datas = $this->wardRepositoryInterface->getWardFromDistrict($request->code);
        return $this->sendResponse($datas, trans('message.success'));
    }
}