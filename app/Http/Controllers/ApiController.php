<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getProducts(Request $request)
    {
        $query = Product::query();

        $query->when(request('category'), function ($q) {
            $q->whereHas('categories', function ($qc) {
                $qc->where('name', request('category'));
            });
            #$q->orderBy('selling_price', 'asc')->orderByRaw('selling_price IS NULL');
        });

        $query->when(request('company'), function ($q) {
            $q->where('company', 'like', '%' . request('company') . '%');
        });

        $query->when(request('selling_price_min') && request('selling_price_max'), function ($q) {
            $q->where('selling_price', '<', request('selling_price_max'))
                ->where('selling_price', '>', request('selling_price_min'));
        });

        $query->when(request('purchase_price_min') && request('purchase_price_max'), function ($q) {
            $q->where('purchase_price', '<', request('purchase_price_max'))
                ->where('purchase_price', '>', request('purchase_price_min'));
        });

        $products = $query->get();

        #$products = Product::all();
        $productsArray = [];
        foreach ($products as $key => $product) {
            $productsArray[$key]['selling_price'] = $product->selling_price;
            $productsArray[$key]['purchase_price'] = $product->purchase_price;
            $productsArray[$key]['name'] = $product->name;
            $productsArray[$key]['company'] = $product->company;
            $productsArray[$key]['url'] = $product->url;
            $productsArray[$key]['last_update'] = Carbon::parse($product->updated_at, 'UTC')->setTimezone('CET')->format('d-m-Y H:i');
        }
        return $productsArray;
    }
}
