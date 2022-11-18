<?php

namespace App\Services\Traits;

use Illuminate\Support\Str;

trait TGetAttributeColumn
{
    public function  getTokenAttribute()
    {
        return Str::random(5) . rand(0001, 9999) . Str::random(5);
    }
}