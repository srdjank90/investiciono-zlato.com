<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricePercentChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'percentage_set',
        'percentage_change',
        'old_price',
        'new_price',
        'notified',
        'checked_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
