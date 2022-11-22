<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeUnit extends Model
{
    use HasFactory;
    protected $table = "administrative_units";
    protected $primaryKey = "id";
    protected $guarded = [];
    public $timestamps = false;
}