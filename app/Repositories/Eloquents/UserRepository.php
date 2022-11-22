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
    }

    public function findRole($id)
    {
        return Role::findOrFail($id);
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

    public function whereUserEmailPhone($email = null, $phone = null)
    {
        // dd($email);
        return $this->model->where(function ($q) use ($email, $phone) {
            if ($email) $q->where('email', $email);
            if ($phone && !$email) {
                $q->where('phone_number', $phone);
            } else {
                $q->orWhere('phone_number', $phone);
            }
            return $q;
        });
    }
    public function whereUserNotRoleFirst($email = null, $phone = null)
    {
        $data = $this->whereUserEmailPhone($email, $phone)->doesntHave('roles')->first();
        return $data;
    }

    public function whereEmailFirst($email)
    {
        return $this->whereMany(['email' => $email])->first();
    }

    public function wherePhoneFirst($phone)
    {
        return $this->whereMany(['phone_number' => $phone])->first();
    }
}