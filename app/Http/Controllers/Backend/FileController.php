<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{
    public function downloadPricesExport($file)
    {
        $filePath = Storage::disk('public')->url('exports/prices/' . $file);
        return redirect($filePath);
    }
}
