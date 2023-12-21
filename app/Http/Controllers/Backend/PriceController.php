<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PricesAllExport;
use App\Exports\PricesExport;
use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId)
    {
        $product = Product::find($productId);
        $prices = Price::where('product_id', $productId)->orderBy('created_at', 'desc')->paginate(60);
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
}
