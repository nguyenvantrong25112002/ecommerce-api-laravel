<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateProduct extends Model
{
    use HasFactory;
    protected $table = "category_product";
    protected $primaryKey = "id";
    public $fillable = [
        'category_id',
        'product_id'
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}