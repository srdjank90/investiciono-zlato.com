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
        'name',
        'slug',
        'subtitle',
        'description',
        'price',
        'price_old',
        'currency',
        'featured',
        'highlighted',
        'special',
        'landing',
        'landing_image',
        'status',
        'sku',
        'ean',
        'quantity',
        'package',
        'limit_qunantity',
        'external_id',
        'external_service',
        'created_by',
        'expiry_date',
        'published_at'
    ];

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
