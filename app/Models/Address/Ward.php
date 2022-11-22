<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $connection = 'mysql_2';
    protected $table = "wards";
    protected $primaryKey = "code";
    protected $guarded = [];
    public $timestamps = false;
}