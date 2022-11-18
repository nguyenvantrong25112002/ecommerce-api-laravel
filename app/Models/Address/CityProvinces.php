<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityProvinces extends Model
{
    use HasFactory;
    protected $table = "city_provinces";
    protected $primaryKey = "id";
    protected $guarded = [];
    public $timestamps = false;

    public function districts()
    {
        return $this->hasMany(District::class, 'city_province_id');
    }
}