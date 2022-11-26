<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Load danh sách admin
     * */
    public function loadListAdmin();


    /**
     * Load danh sách sản phẩm mới
     * */
    public function getNew();


    /**
     * Load danh sách sản phẩm có sale
     * */
    public function getSale();


    /**
     * Chi tiết sản phẩm (api)
     * */
    public function showApi(string $slug);


    /**
     * Query không có $id nhưng sẽ có $id_array
     * */
    public function getExceptInByID(int $id, array $id_array);
}