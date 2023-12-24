<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPrices()
    {
        $prices = Price::with('product')->get();
        $pricesArray = [];
        foreach ($prices as $key => $price) {
            $pricesArray[$key]['selling_price'] = $price->selling_price;
            $pricesArray[$key]['purchase_price'] = $price->purchase_price;
            $pricesArray[$key]['name'] = $price->product->name;
            $pricesArray[$key]['company'] = $price->product->company;
        }

        return $pricesArray;
    }
}
