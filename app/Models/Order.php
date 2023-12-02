<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'oid',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'address',
        'city',
        'zip',
        'company',
        'company_address',
        'pib',
        'note',
        'subtotal',
        'total',
        'status',
        'invoice_sent',
        'shipping_service',
        'shipping_number',
        'shipped_at'
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function totalFormated()
    {
        $formated = number_format($this->total, 2, ',', '.');
        return $formated;
    }

    public function subtotalFormated()
    {
        $formated = number_format($this->subtotal, 2, ',', '.');
        return $formated;
    }

    public function shippingPriceFormated()
    {
        $formated = number_format($this->shipping_price, 2, ',', '.');
        return $formated;
    }

    public function statusLabel()
    {
        $label = "";
        if ($this->status == 'pending') {
            $status = trans("pending");
            $label = '<span class="badge bg-warning"><i class="bi bi-clock"></i> ' . $status . '</span>';
        }
        if ($this->status == 'shipping') {
            $status = trans("shipping");
            $label = '<span class="badge bg-secondary"><i class="bi bi-truck"></i> ' . $status . '</span>';
        }
        if ($this->status == 'completed') {
            $status = trans("completed");
            $label = '<span class="badge bg-success"><i class="bi bi-check-square"></i> ' . $status . '</span>';
        }
        if ($this->status == 'canceled') {
            $status = trans("canceled");
            $label = '<span class="badge bg-danger"><i class="bi bi-x-circle"></i> ' . $status . '</span>';
        }

        return $label;
    }

    public function createDateFormated($showTime = false)
    {
        $format = "d-m-Y";
        if ($showTime) {
            $format = $format . " H:i";
        }

        return $this->created_at->format($format);
    }

    public function updateDateFormated($showTime = false)
    {
        $format = "d-m-Y";
        if ($showTime) {
            $format = $format . " H:i";
        }
        return $this->updated_at->format($format);
    }
}
