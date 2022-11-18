<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'super admin'],
            ['name' => 'admin'],
            ['name' => 'staff'],
            ['name' => 'user'],
        ];
        foreach ($roles as $r) {
            Role::create($r);
        }
    }
}