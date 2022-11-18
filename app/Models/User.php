<?php

namespace App\Models;

use App\Services\Builder\Builder;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'name',
        'image',
        'email',
        'phone_number',
        'birthday',
        'status',
        'google_id',
        'facebook_id',
        'token',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}