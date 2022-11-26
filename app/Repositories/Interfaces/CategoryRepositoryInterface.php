<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get data admin
     * */
    public function getListAdmin();

    /**
     * Get data parent
     * */
    public function getParent();
}