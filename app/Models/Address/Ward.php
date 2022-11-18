<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = "ward";
    protected $primaryKey = "id";
    protected $guarded = [];
    public $timestamps = false;
}