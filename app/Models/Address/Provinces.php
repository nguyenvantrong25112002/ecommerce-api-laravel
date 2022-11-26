<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;
    protected $table = "provinces";
    protected $primaryKey = "code";
    protected $guarded = [];
    public $timestamps = false;

    public function districts()
    {
        return $this->hasMany(District::class, 'city_province_id');
    }
}