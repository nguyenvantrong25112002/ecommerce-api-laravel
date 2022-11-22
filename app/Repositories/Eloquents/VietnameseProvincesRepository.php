<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\VietnameseProvincesInterface;

class VietnameseProvincesRepository extends BaseRepository implements VietnameseProvincesInterface
{
    public function administrativeRegion_Model()
    {
        return $this->model;
    }
}