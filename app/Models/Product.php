<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'unique_key',
        'name',
        'name_default',
        'slug',
        'slug_default',
        'producer',
        'producer_short',
        'quantity_type',
        'url',
        'short',
        'declaration',
        'description',
        'price_id',
        'selling_price',
        'purchase_price',
        'selling_price_percentage_change',
        'purchase_price_percentage_change',
        'currency',
        'company',
        'last_price_at',
        'status',
        'price_id',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Company::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class)->orderBy('created_at', 'desc');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class)->orderBy('parent_id', 'asc');
    }

    public function files()
    {
        return $this->belongsToMany(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function meta()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function seo()
    {
        return $this->hasOne(SeoMetaTag::class, 'model_id')->where('model', 'Product');
    }
}
