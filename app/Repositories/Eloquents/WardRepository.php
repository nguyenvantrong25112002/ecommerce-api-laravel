<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\WardRepositoryInterface;

class WardRepository extends BaseRepository implements WardRepositoryInterface
{
    public function getWardFromDistrict($code)
    {
        $datas = $this->model::where('district_code', $code)->get();
        return $datas;
    }
}