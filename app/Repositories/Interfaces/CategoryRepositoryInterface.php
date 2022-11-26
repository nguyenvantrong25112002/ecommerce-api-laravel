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


    /**
     * Get active
     * */
    public function getActive();

    /**
     * Get list api
     * */
    public function getListApi();
}