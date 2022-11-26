<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\AddresUserRepositoryInterface;

class AddresUserRepository extends BaseRepository implements AddresUserRepositoryInterface
{
    public function getAddresFromUser($user_id)
    {
        return $this->model::where('user_id', $user_id)->get();
    }
}