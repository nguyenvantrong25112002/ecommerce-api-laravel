<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getList(array $request, array $with);
    public function getParent();
}