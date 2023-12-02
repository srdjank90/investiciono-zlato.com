<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $options = getOptions('setting_');
        return view('backend.settings.index', compact('options'));
    }
}
