<?php

namespace App\Models;

use App\Casts\FormatDateTime;
use App\Casts\FormatImageGet;
use App\Models\GalleryProducts;
use App\Services\Builder\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Services\Traits\TGetAttributeColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, TGetAttributeColumn;
    protected $table = "products";
    protected $primaryKey = "id";
    public $fillable = [
        'name',
        'slug',
        'image',
        'price',
        'price_sale',
        'sale_off',
        'quantity',
        'description',
        'details',
        'status',
        'view',
    ];
    protected $appends = [
        'token',
    ];
    protected $casts = [
        'created_at' => FormatDateTime::class,
        'updated_at' =>  FormatDateTime::class,
        'image' => FormatImageGet::class,
    ];

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    public function categorys()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function gallerys()
    {
        return $this->hasMany(GalleryProducts::class, 'product_id', 'id');
    }

    public function properties()
    {
        return $this->belongsToMany(Properties::class, 'product_properties', 'product_id', 'properties_id');
    }

    public function species()
    {
        return $this->belongsToMany(Species::class, 'product_species', 'product_id', 'species_id');
    }
}