<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'path_original',
        'size',
        'mime_type',
        'extension',
        'media_type',
        'created_by'
    ];
}
