<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeRegion extends Model
{
    use HasFactory;
    protected $connection = 'mysql_2';
    protected $table = "administrative_regions";
    protected $primaryKey = "id";
    protected $guarded = [];
    public $timestamps = false;
}