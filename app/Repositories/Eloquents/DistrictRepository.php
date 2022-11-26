<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\DistrictRepositoryInterface;

class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface
{
    public function getDistrictFromProvinces($code)
    {
        $datas = $this->model::where('province_code', $code)->get();

        return $datas;
    }
}