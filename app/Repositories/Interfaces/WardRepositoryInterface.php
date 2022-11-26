<?php

namespace App\Repositories\Interfaces;

interface  WardRepositoryInterface extends BaseRepositoryInterface
{
    public function getWardFromDistrict($code);
}