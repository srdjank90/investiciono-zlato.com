<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image_id', 'favorite_flag', 'description', 'parent_id', 'min_order_quantity', 'external_id', 'external_service', 'created_by'];
    protected $appends = ['products_count'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function image()
    {
        return $this->belongsTo(File::class, 'image_id', 'id');
    }

    public function getProductsCountAttribute()
    {
        return $this->belongsToMany(Product::class)->count();
    }

    public function childs()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id');
    }
}
