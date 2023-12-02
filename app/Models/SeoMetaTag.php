<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMetaTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'model_id',
        'title',
        'description',
        'keywords'
    ];
}
