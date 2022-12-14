<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $connection = 'mysql_2';
    protected $table = "districts";
    protected $primaryKey = "code";
    protected $guarded = [];
    public $timestamps = false;

    // public function cityProvinces()
    // {
    //     return $this->belongsTo(CityProvinces::class, 'city_province_id');
    // }
}