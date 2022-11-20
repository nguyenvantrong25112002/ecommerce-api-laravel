<?php

namespace App\Repositories\Eloquents;

use Spatie\Permission\Models\Role;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getListUser()
    {
        $datas = $this->model->where(function ($q) {
            $q->search(request('search') ?? null, ['name', 'email', 'phone_number']);
            return $q;
        })->doesntHave('roles')
            ->sortBy(request('sort') ?? null, request('sort-by') ?? null)
            ->paginate(request('limit') ?? 5);
        $datas->setCollection($datas->getCollection()->makeHidden([
            'image', 'birthday', 'google_id', 'facebook_id', 'token', 'created_at'
        ]));
        return $datas;
    }
    public function getAllRole()
    {
        return Role::all();
        // return [
        //     config('util.ROLE_SUPER_ADMIN'),
        //     config('util.ROLE_ADMIN'),
        //     config('util.ROLE_STAFF')
        // ];
    }

    public function getListAdmin()
    {
        $datas = $this->model->where(function ($q) {
            $q->role($this->getAllRole()->pluck('name'));
            $q->search(request('search') ?? null, ['name', 'email', 'phone_number']);
            return $q;
        })->has('roles')->with('roles')
            ->paginate(request('limit') ?? 5);
        $datas->setCollection($datas->getCollection()->makeHidden([
            'image', 'birthday', 'google_id', 'facebook_id', 'token', 'created_at'
        ]));

        // $datas->setCollection(
        //     $datas->getCollection()
        //         ->map(function ($item, $key) {
        //             // $item->roles = $item->roles->name;
        //             // return $item;
        //             dump($item->roles);
        //         })
        // );
        return $datas;
    }

    public function searchUser()
    {
        $datas = $this->model->where(function ($q) {
            $q->where('email', request()->information);
            $q->orWhere('phone_number', request()->information);
            return $q;
        })->doesntHave('roles')->first();
        return $datas;
    }
}