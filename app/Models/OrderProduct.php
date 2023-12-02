<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Metadata\Metadata;

class OrderProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'meta_data',
        'single_price',
        'total_price',
        'currency'
    ];

    protected $appends = ['meta_external_id'];

    public function order()
    {
        return $this->belongsTo(Order::class)->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function getMetaExternalIdAttribute()
    {
        $metaDataId = json_decode($this->meta_data)[0]->valueId;
        $externalId = ProductMeta::find($metaDataId);
        return $externalId->external_id;
    }

    public function singlePriceFormated()
    {
        $formated = number_format($this->single_price, 2, ',', '.');
        return $formated;
    }

    public function totalPriceFormated()
    {
        $formated = number_format($this->total_price, 2, ',', '.');
        return $formated;
    }
}
