<?php

namespace App\Models;

use App\Casts\FormatDateTime;
use App\Services\Builder\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categorys";
    protected $primaryKey = "id";
    public $fillable = [
        'name',
        'order',
        'status',
        'parent_id',
        'slug',
    ];
    // protected $appends = [
    //     'slug_name',
    // ];
    // public function getSlugNameAttribute()
    // {
    //     return "{$this->name} {$this->slug}";
    // }
    protected $casts = [
        'created_at' => FormatDateTime::class,
        'updated_at' =>  FormatDateTime::class,
    ];
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }

    public function parent()
    {
        return $this->where('parent_id', 0);
    }

    function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with(['children' => function ($q) {
            return $q->withCount(['products']);
        }]);
    }
}