<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Weidner\Goutte\GoutteFacade;

class PriceUpdateController extends Controller
{
    public function updatePrices()
    {
        #$this->investicionoZlatoUpdatePrices();        // Slow
        $this->tavexUpdatePrices();                     // Fast
        $this->goldenSpaceUpdatePrices();               // Fast
    }

    public function investicionoZlatoUpdatePrices()
    {
        $products = Product::where('slug', 'LIKE', '%-investiciono-zlato.rs')->get();

        foreach ($products as $product) {
            $sellingPrice = $this->fetchInvesticionoZlatoItemSellingPrice($product->url);
            $purchasePrice = $this->fetchInvesticionoZlatoItemPurchasePrice($product->url);
        }
    }

    function fetchInvesticionoZlatoItemPurchasePrice($url)
    {
        $price = [];
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $price = $crawler->filter('.price-single')->last()->text();
            return $price;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        if (count($price) > 0) {
            return $price[0][0];
        } else {
            return '';
        }
    }

    function fetchInvesticionoZlatoItemSellingPrice($url)
    {
        $price = [];
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $price[] = $crawler->filter('.price-wrapper')->each(function ($node) {
                $pr = $node->text();
                return $pr;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        if (count($price) > 0) {
            return $price[0][0];
        } else {
            return '';
        }
    }

    /**
     * Tavex Update Prices
     * Function updates product prices from tavex.rs
     */
    function tavexUpdatePrices()
    {
        $url = 'https://tavex.rs/zlato/';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('.product--gold')->each(function ($node) {
                $product['url'] = $node->extract(array('href'))[0];
                $priceCheck = $node->filter('.product__meta .product__meta-box .product__prices .product__price--single .product__price-value')->count();
                $product['selling_price'] = null;
                if ($priceCheck > 0) {
                    $product['selling_price'] = $node->filter('.product__meta .product__meta-box .product__prices .product__price--single .product__price-value')->first()->text();
                    $product['selling_price'] = str_replace('din', '', str_replace(' ', '', $product['selling_price']));
                }
                $purchasePriceCheck = $node->filter('.product__meta .product__meta-box .product__prices .product__price--buy .product__price-value')->count();
                $product['purchase_price'] = null;
                if ($purchasePriceCheck > 0) {
                    $product['purchase_price'] = $node->filter('.product__meta .product__meta-box .product__prices .product__price--buy .product__price-value')->first()->text();
                    $product['purchase_price'] = str_replace('din', '', str_replace(' ', '', $product['purchase_price']));
                }
                $findProduct = Product::where('url', $product['url'])->first();
                if ($findProduct) {
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => $product['selling_price'],
                        'purchase_price' => $product['purchase_price']
                    ];
                    $price = Price::create($priceData);
                }
                return $product;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Golden Space Update Prices
     * Function updates product prices from golden-space.rs
     */
    function goldenSpaceUpdatePrices()
    {
        $url = 'https://golden-space.rs/investiciono-zlato/';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('.elementor-heading-title.elementor-size-default')->each(function ($node) {
                $product['url'] = $node->children('a')->extract(array('href'))[0];
                $product['selling_price'] = $node->closest('.elementor-element-populated')->filter('.elementor-widget-text-editor .woocommerce-Price-amount')->first()->text();
                $product['purchase_price'] = $node->closest('.elementor-element-populated')->filter('.elementor-widget-text-editor .woocommerce-Price-amount')->last()->text();

                $findProduct = Product::where('url', $product['url'])->first();
                if ($findProduct) {
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => floatval(str_replace('.', '', str_replace('RSD', '', trim($product['selling_price'])))),
                        'purchase_price' => floatval(str_replace('.', '', str_replace('RSD', '', trim($product['purchase_price'])))),
                    ];
                    $price = Price::create($priceData);
                }
                return $product;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
