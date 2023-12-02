<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OptionController extends Controller
{
    public function getOptions(Request $request)
    {
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            if (str_contains($key, '_opt')) {
                updateOption($key, $value);
            }
        }
        return back();
    }
}
