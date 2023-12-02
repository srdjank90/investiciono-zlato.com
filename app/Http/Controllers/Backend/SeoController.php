<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SeoMetaTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seo = SeoMetaTag::all();
        return $seo;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, $model, $id)
    {
        if (isset($request->id) && $request->id !== null) {
            $seo = SeoMetaTag::find($request->id);
            $seo->title = $request->title;
            $seo->description = $request->description;
            $seo->keywords = $request->keywords;
            $seo->save();
        } else {
            $seo = new SeoMetaTag();
            $seo->model = $model;
            $seo->model_id = $id;
            $seo->title = $request->title;
            $seo->description = $request->description;
            $seo->keywords = $request->keywords;
            $seo->save();
        }

        return $seo;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $model, $id)
    {
        $seo = SeoMetaTag::where('model', $model)->where('model_id', $id)->first();
        return $seo;
    }
}
