<?php

namespace App\Http\Controllers;

use App\Models\Address\CityProvinces;
use App\Models\Address\District;
use App\Models\Address\Ward;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $cityProvincesModel;
    protected $districtModel;
    protected $wardModel;
    public function __construct(CityProvinces $cityProvinces, District $district, Ward $ward)
    {
        $this->cityProvincesModel = $cityProvinces;
        $this->districtModel = $district;
        $this->wardModel = $ward;
    }
    protected function cityProvincesQuery()
    {
        $data = $this->cityProvincesModel::query();
        return $data;
    }
    public function cityProvincesGet()
    {
        $data = $this->cityProvincesQuery()->get();
        return response()->json([
            'status' => true,
            'payload' => $data,
        ]);
    }

    public function getDistrict(Request $request)
    {
        // $data = $this->cityProvincesModel::find($request->id)->districts();
        $data = $this->districtModel::where('city_province_id', $request->id)->get();
        return response()->json([
            'status' => true,
            'payload' => $data,
        ]);
    }
    public function getWard(Request $request)
    {
        $data = $this->wardModel::where('district_id', $request->id)->get();
        return response()->json([
            'status' => true,
            'payload' => $data,
        ]);
    }
}