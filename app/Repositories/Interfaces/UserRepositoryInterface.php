<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Lấy danh sách user không có quyền
     * */
    public function getListUser();

    /**
     * Lấy danh sách admin
     * */
    public function getListAdmin();

    /**
     * Get all quyền
     * */
    public function getAllRole();

    public function findRole(int $id);

    public function whereUserNotRoleFirst(string $email = null, int $phone = null);

    public function whereEmailFirst(string $email);

    public function wherePhoneFirst(int $phone);
}