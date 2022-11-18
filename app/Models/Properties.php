<?php

namespace App\Models;

use App\Services\Builder\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Properties extends Model
{
    use HasFactory;
    protected $table = "properties";
    protected $primaryKey = "id";
    public $fillable = [
        'name',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($q) {
            $q->species()->delete();
        });
    }

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_properties', 'properties_id', 'product_id');
    }

    public function species()
    {
        return $this->hasMany(Species::class,  'properties_id', 'id');
    }
}