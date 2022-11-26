<?php

namespace App\Repositories\Interfaces;

interface  DistrictRepositoryInterface extends BaseRepositoryInterface
{
    public function getDistrictFromProvinces($code);
}