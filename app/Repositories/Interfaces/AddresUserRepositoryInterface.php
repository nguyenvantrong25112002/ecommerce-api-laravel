<?php

namespace App\Repositories\Interfaces;

interface AddresUserRepositoryInterface extends BaseRepositoryInterface
{
    /** 
     * @param int $user_id 
     * Lấy ra địa chỉ người dùng từ id người dùng*/
    public function getAddresFromUser(int $user_id);
}