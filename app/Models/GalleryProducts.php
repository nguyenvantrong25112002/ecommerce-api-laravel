<?php

namespace App\Models;

use App\Casts\FormatImageGet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryProducts extends Model
{
    use HasFactory;
    protected $table = "gallery_products";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $fillable = [
        'product_id',
        'order',
        'image',
    ];
    protected $casts = [
        // 'created_at' => FormatDate::class,
        // 'updated_at' =>  FormatDate::class,
        'image' => FormatImageGet::class,
    ];
    protected $hidden = [
        'updated_at',
        'created_at'
    ];
}