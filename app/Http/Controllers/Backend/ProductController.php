<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends BackendController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Items per page
        $currency = getOption('product_currency_opt', 'EUR');
        $perPage = getOption('product_per_page_opt', 8);
        $search = '';
        if ($request->search && $request->search !== '') {
            $search = $request->search;
        }
        if ($search !== '') {
            $products = Product::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%')
                ->paginate($perPage);
        } else {
            $products = Product::paginate($perPage);
        }
        $productMetas = getOption('product_metas_opt', []);

        return view('backend.products.index', compact(['products', 'search', 'currency', 'productMetas']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currency = getOption('product_currency_opt', 'EUR');
        $productCategories = ProductCategory::all();
        return view('backend.products.create', compact('productCategories', 'currency'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product($request->all());
        #$product->created_by = Auth::user()->id;
        $product->slug = Str::slug($product->name, '-');
        $product->save();
        $id = $product->id;
        return response()->json(['success' => true, 'error' => null, 'id' => $id, 'url' => route('backend.products.edit', $id)]);
    }

    public function landing($id)
    {
        $product = Product::find($id);
        if (isset($product->landing) && $product->landing !== '') {
            $landing = json_decode($product->landing);
        } else {
            $landing = [];
        }
        return view('backend.products.landing', compact('product', 'landing'));
    }

    public function landingUpdate(Request $request, $id)
    {
        $product = Product::find($request->id);
        $itemImage = '';
        if ($request->image) {
            $imageFile = $request->file('image');
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
            $itemImage = $path;
        }

        $data = [
            'uid' => $request->uid,
            'title' => $request->title,
            'text' => $request->text,
            'imagePosition' => $request->imagePosition,
            'image' => $itemImage
        ];

        if (isset($product->landing) && $product->landing !== '') {
            $landing = json_decode($product->landing);
        } else {
            $landing = [];
        }
        array_push($landing, $data);
        $product->landing = json_encode($landing);
        $product->save();

        return redirect()->back();
    }

    public function landingItemUpdate(Request $request, $id)
    {
        $product = Product::find($request->id);
        $itemImage = '';
        if ($request->image) {
            $imageFile = $request->file('image');
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
            $itemImage = $path;
        }

        if (isset($product->landing) && $product->landing !== '') {
            $landing = json_decode($product->landing);
        } else {
            $landing = [];
        }
        foreach ($landing as $item) {
            if ($item->uid == $request->uid) {
                $item->title = $request->title;
                $item->text = $request->text;
                $item->imagePosition = $request->imagePosition;
                if ($itemImage != '') {
                    $item->image = $itemImage;
                }
            }
        }
        Log::info($landing);
        $product->landing = json_encode($landing);
        $product->save();

        return redirect()->back();
    }

    public function landingDelete(Request $request, $id)
    {
        $product = Product::find($id);
        if (isset($product->landing) && $product->landing !== '') {
            $landing = json_decode($product->landing);
        } else {
            $landing = [];
        }
        $newLanding = [];
        foreach ($landing as $item) {
            if ($item->uid !== $request->uid) {
                array_push($newLanding, $item);
            }
        }
        $product->landing = json_encode($newLanding);
        $product->save();

        return redirect()->back();
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
        $productMetas = getOption('product_metas_opt', []);
        $currency = getOption('product_currency_opt', 'EUR');
        $product = Product::with('categories')->findOrFail($id);
        $productCategories = ProductCategory::all();
        $productCategoriesIds = $product->categories->pluck('id')->toArray();
        return view('backend.products.edit', compact(['product', 'productCategories', 'productCategoriesIds', 'currency', 'productMetas']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        $product = Product::find($id);
        $product->update($request->except('landing_image'));
        $product->update([
            'special' => $request->special == 1 ? 1 : 0,
            'highlighted' => $request->highlighted == 1 ? 1 : 0,
        ]);

        $product->categories()->sync($request->categories);

        if ($request->landing_image) {
            $imageFile = $request->file('landing_image');
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
            $product->landing_image = $path;
        }
        $product->save();

        return redirect()->route('backend.products.edit', [$id])
            ->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['type' => 'success', 'message' => 'Deleted!'], 200);
    }

    /**
     * Settings for Products
     */
    public function timeOffers()
    {
        $products = Product::all();
        $productCategories = ProductCategory::all();
        $options = getOptions('product_');
        return view('backend.products.timeOffers', compact(['products', 'productCategories', 'options']));
    }

    /**
     * Settings for Products
     */
    public function settings()
    {
        $products = Product::all();
        $productCategories = ProductCategory::all();
        $options = getOptions('product_');
        return view('backend.products.settings', compact(['products', 'productCategories', 'options']));
    }

    public function settingsMetasStore(Request $request)
    {
        $productMetasSettings = getOption('product_metas_opt', []);
        array_push($productMetasSettings, $request->except('_token'));
        updateOption('product_metas_opt', $productMetasSettings);
        return response()->json(['success' => true, 'error' => null, 'url' => route('backend.products.settings')]);
    }

    public function imagesStore(Request $request, $id)
    {
        $product = Product::find($id);
        $imageFiles = $request->file('images');
        $uploadedImages = [];
        $uploadedImagesIds = [];
        foreach ($imageFiles as $index => $imageFile) {
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
            $uploadedImages[$index] = $uploadedImage;
            $product->files()->attach($uploadedImage->id);
            array_push($uploadedImagesIds, $uploadedImage->id);
        }

        return response()->json(['success' => true, 'data' => $uploadedImages]);
    }

    public function imageRemove($productId, $imageId)
    {
        $product = Product::find($productId);
        $product->files()->detach($imageId);
        return response()->json(['success' => true]);
    }

    public function regenerateOriginalName($imagePath, $originalName, $extension)
    {
        $newOriginalName = '';
        $totalFilesSameName = File::where('path', $imagePath . "/" . $originalName)->count();
        $newOriginalName = str_replace("." . $extension, "-" . $totalFilesSameName . "." . $extension, $originalName);
        return $newOriginalName;
    }
}
