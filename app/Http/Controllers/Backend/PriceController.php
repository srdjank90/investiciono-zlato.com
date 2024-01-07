<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PricesAllExport;
use App\Exports\PricesExport;
use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PriceController extends BackendController
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId)
    {
        $product = Product::find($productId);
        $prices = Price::where('product_id', $productId)->orderBy('created_at', 'desc')->paginate(360);
        return view('backend.products.prices', compact(['prices', 'product']));
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
        //
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
        //
    }

    public function export(string $id)
    {
        $filename = '';
        $price = Price::with(['product'])->find($id);
        $filename = $price->product->slug . '-prices.xlsx';
        return Excel::download(new PricesExport($id), $filename);
    }

    public function exportAll()
    {
        return Excel::download(new PricesAllExport(), 'prices.xlsx');
    }

    // Export all prices to excel file
    public function exportAllPricesCron()
    {
        $filename = '';
        $dateTime = Carbon::now()->format('d_m_Y_H_i');
        $filename = 'prices_all_' . $dateTime . '.xlsx';
        $path = 'exports/prices/' . $filename;
        Excel::store(new PricesAllExport(), $path, 'public');
    }

    public function exportProductPrices()
    {
        $filename = '';
        $dateTime = Carbon::now()->format('d_m_Y_H_i');
        $products = Product::all();
        foreach ($products as $product) {
            $filename = $product->slug . '_' . $dateTime . '.xlsx';
            $path = 'exports/products/' . $product->slug . '/' . $filename;
            Excel::store(new PricesExport($product->id), $path, 'public');
        }
    }
}
