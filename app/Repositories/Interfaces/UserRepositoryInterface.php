<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface extends BaseRepositoryInterface
{

    public function getListUser();

    public function getListAdmin();

    public function getAllRole();

    public function searchUser();
}