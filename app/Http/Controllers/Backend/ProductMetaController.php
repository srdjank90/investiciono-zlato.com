<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\ProductMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductMetaController extends BackendController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productMeta = new ProductMeta();

        $request->validate([
            'name' => 'required'
        ]);

        // Handle value for Meta
        if ($request->hasFile('value')) {
            $uploadedFile = $this->imagesStore($request->value);
            $value = $uploadedFile->path;
        } elseif (isset($request->value)) {
            $value = $request->value;
        } else {
            $value = '';
        }


        $metaData = [
            'name' => $request->input('name'),
            'product_id' => $request->input('product_id'),
            'type' => $request->input('type'),
            'value' => $value
        ];

        $meta = $productMeta->create($metaData);

        return response()->json(['success' => true, 'error' => null, 'meta' => $meta]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meta = ProductMeta::findOrFail($id);
        $meta->delete();
        return response()->json(['success' => true, 'error' => null, 'meta' => $meta]);
    }

    public function imagesStore($imageFile)
    {
        $extension  = $imageFile->getClientOriginalExtension();
        $originalName = $imageFile->getClientOriginalName();
        $mimeType = $imageFile->getMimeType();
        $imagePath = date('Y') . "/" . date('m');
        $size = $imageFile->getSize();
        // Check is image already exists
        if (File::where('path', $imagePath . "/" . $originalName)->exists()) {
            $originalName = $this->regenerateOriginalName($imagePath, $originalName, $extension);
        }
        $path = Storage::disk('public')->putFileAs($imagePath, $imageFile, $originalName);
        $imageData = [
            "name" => str_replace("." . $extension, "", $originalName),
            "path" => $path,
            "size" => $size,
            "mime_type" => $mimeType,
            "extension" => $extension,
            "media_type" => "image",
            "created_by" => Auth::id()
        ];
        $uploadedImage = File::create($imageData);
        return $uploadedImage;
    }
}
