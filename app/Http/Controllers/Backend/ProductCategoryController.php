<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductCategoryController extends BackendController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Items per page
        $perPage = 10;
        $productsCategories = ProductCategory::paginate($perPage);
        return view('backend.products.categories.index', compact(['productsCategories']));
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
        $productsCategories = new ProductCategory($request->except('category_image'));
        #$productsCategories->created_by = Auth::user()->id;

        if ($request->category_image) {
            $imageFile = $request->file('category_image');
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
            $uploadedImage = File::create($imageData)->id;
            $productsCategories->image_id = $uploadedImage;
        }

        $productsCategories->save();

        return redirect()->route('backend.products.categories.index');
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
        $productCategory = ProductCategory::find($id);
        $productCategory->update($request->except('category_image'));
        if ($request->category_image) {
            $imageFile = $request->file('category_image');
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
            $uploadedImage = File::create($imageData)->id;
            $productCategory->image_id = $uploadedImage;
        }
        $productCategory->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCategory = ProductCategory::with('products')->find($id);
        foreach ($productCategory->products as $product) {
            $product->categories()->sync([1]);
        }
        $productCategory->delete();
        return response()->json(['type' => 'success', 'message' => 'Deleted!'], 200);
    }

    public function regenerateOriginalName($imagePath, $originalName, $extension)
    {
        $newOriginalName = '';
        $totalFilesSameName = File::where('path', $imagePath . "/" . $originalName)->count();
        $newOriginalName = str_replace("." . $extension, "-" . $totalFilesSameName . "." . $extension, $originalName);
        return $newOriginalName;
    }
}
