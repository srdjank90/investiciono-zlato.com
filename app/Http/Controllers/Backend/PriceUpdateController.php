<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Weidner\Goutte\GoutteFacade;
use Symfony\Component\DomCrawler\Crawler;

class PriceUpdateController extends Controller
{
    public function updatePricesApi()
    {
        $checkedAt = Carbon::now();

        $url = env('SCRAPER_API', 'https://radoviutoku.com/api');
        $response = Http::get($url . '/prices');
        if ($response->successful()) {
            $prices = $response->json();
            foreach ($prices as $price) {
                Price::create($price);
                $product = Product::find($price['product_id']);
                if ($product) {
                    NotificationController::storePricePercentChange($product->selling_price, $price['selling_price'], $product, $checkedAt);
                    $product->selling_price = $price['selling_price'];
                    $product->purchase_price = $price['purchase_price'];
                    $product->save();
                }
            }
        } else {
        }
    }

    public function updatePrices()
    {
        $this->updateEurExchange();                     // Get EUR value
        $this->investicionoZlatoUpdatePrices();         // Bad
        $this->tavexUpdatePrices();                     // Good
        $this->goldenSpaceUpdatePrices();               // Good
        $this->zlatoMojeUpdatePrices();                 // Good
        $this->kupiZlatoUpdatePrices();                 // Good
        $this->insignitusUpdatePrices();                // Good
        $this->dokInvestUpdatePrices();                 // Good
        $this->gvsSrbijaUpdatePrices();                 // Good
        $this->investicionoZlato2UpdatePrices();        // Middle
    }

    /**
     * Investiciono Zlato Update Prices - 1
     * Function updates product prices from
     */
    public function investicionoZlatoUpdatePrices()
    {
        $products = Product::where('company_id', 1)->get();

        foreach ($products as $product) {
            $divider = $this->findDividerForMultipack($product);
            $sellingPrice = $this->fetchInvesticionoZlatoItemSellingPrice($product->url);
            $purchasePrice = $this->fetchInvesticionoZlatoItemPurchasePrice($product->url);
            $priceData = [
                'product_id' => $product->id,
                'selling_price' => floatval(str_replace('.', '', str_replace('din', '', trim($sellingPrice)))) / $divider,
                'purchase_price' => floatval(str_replace('.', '', str_replace('din', '', trim($purchasePrice)))) / $divider,
            ];
            $price = Price::create($priceData);

            $percentageChangeSelling = 0;
            if (($product->selling_price && $product->selling_price != 0) && $priceData['selling_price'] != 0) {
                $percentageChangeSelling = (($product->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
            }
            $product->selling_price_percentage_change = $percentageChangeSelling;

            $percentageChangePurchase = 0;
            if (($product->purchase_price && $product->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                $percentageChangePurchase = (($product->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
            }
            $product->purchase_price_percentage_change = $percentageChangePurchase;

            $product->selling_price = $priceData['selling_price'];
            $product->purchase_price = $priceData['purchase_price'];
            $product->save();
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
     * Tavex Update Prices - 2
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
                    $divider = $this->findDividerForMultipack($findProduct);
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => $product['selling_price'] / $divider,
                        'purchase_price' => $product['purchase_price'] / $divider
                    ];
                    $price = Price::create($priceData);
                    $percentageChangeSelling = 0;
                    if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                        $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                    }
                    $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                    $percentageChangePurchase = 0;
                    if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                        $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                    }
                    $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                    $findProduct->selling_price = $priceData['selling_price'];
                    $findProduct->purchase_price = $priceData['purchase_price'];
                    $findProduct->save();
                }
                return $product;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Golden Space Update Prices - 3
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
                    $divider = $this->findDividerForMultipack($findProduct);
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => floatval(str_replace('.', '', str_replace('RSD', '', trim($product['selling_price'])))) / $divider,
                        'purchase_price' => floatval(str_replace('.', '', str_replace('RSD', '', trim($product['purchase_price'])))) / $divider,
                    ];
                    $price = Price::create($priceData);
                    $percentageChangeSelling = 0;
                    if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                        $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                    }
                    $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                    $percentageChangePurchase = 0;
                    if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                        $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                    }
                    $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                    $findProduct->selling_price = $priceData['selling_price'];
                    $findProduct->purchase_price = $priceData['purchase_price'];
                    $findProduct->save();
                }
                return $product;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Zlato Moje Update Prices - 4
     * Function updates product prices from zlatomoje.rs
     */
    function zlatoMojeUpdatePrices()
    {
        $url = 'https://www.zlatomoje.rs/';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('section li[data-hook="product-list-grid-item"]')->each(function ($node) {
                $product['url'] = $node->filter('[data-hook="product-item-product-details-link"]')->first()->extract(array('href'))[0];
                $product['selling_price'] =  $node->filter('[data-hook="product-item-price-to-pay"]')->first()->text();
                $product['purchase_price']  = null;

                $findProduct = Product::where('url', $product['url'])->first();

                if ($findProduct) {
                    $divider = $this->findDividerForMultipack($findProduct);
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => floatval(str_replace('.', '', str_replace('РСД', '', trim($product['selling_price'])))) / $divider,
                        'purchase_price' => floatval(str_replace('.', '', str_replace('РСД', '', trim($product['purchase_price'])))) / $divider,
                    ];
                    $price = Price::create($priceData);
                    $percentageChangeSelling = 0;
                    if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                        $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                    }
                    $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                    $percentageChangePurchase = 0;
                    if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                        $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                    }
                    $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                    $findProduct->selling_price = $priceData['selling_price'];
                    $findProduct->purchase_price = $priceData['purchase_price'];
                    $findProduct->save();
                }
                return $product;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Kupi Zlato Update Prices - 5
     * Function updates products prices from kupizlato.com
     */
    function kupiZlatoUpdatePrices()
    {
        $url = 'https://www.kupizlato.com/kategorija-proizvoda/cene/';
        $url2 = 'https://www.kupizlato.com/kategorija-proizvoda/cene/page/2/';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('.product-type-simple')->each(function ($node) {
                $product['url'] = $node->filter('[data-widget_type="jet-woo-builder-archive-product-title.default"] a')->first()->extract(array('href'))[0];
                $product['selling_price'] =  $node->filter('[data-widget_type="jet-woo-builder-archive-product-price.default"] .jet-woo-product-price')->first()->text();
                $product['purchase_price']  = null;
                $findProduct = Product::where('url', $product['url'])->first();
                $divider = $this->findDividerForMultipack($findProduct);
                if ($findProduct) {
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => floatval(str_replace('.', '', str_replace('рсд', '', trim($product['selling_price'])))) / $divider,
                        'purchase_price' => floatval(str_replace('.', '', str_replace('рсд', '', trim($product['purchase_price'])))) / $divider,
                    ];
                    $price = Price::create($priceData);
                    $percentageChangeSelling = 0;
                    if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                        $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                    }
                    $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                    $percentageChangePurchase = 0;
                    if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                        $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                    }
                    $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                    $findProduct->selling_price = $priceData['selling_price'];
                    $findProduct->purchase_price = $priceData['purchase_price'];
                    $findProduct->save();
                }
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        try {
            $crawler = GoutteFacade::request('GET', $url2);
            $products2 = $crawler->filter('.product-type-simple')->each(function ($node) {
                $product['url'] = $node->filter('[data-widget_type="jet-woo-builder-archive-product-title.default"] a')->first()->extract(array('href'))[0];
                $product['selling_price'] =  $node->filter('[data-widget_type="jet-woo-builder-archive-product-price.default"] .jet-woo-product-price')->first()->text();
                $product['purchase_price']  = null;
                $findProduct = Product::where('url', $product['url'])->first();
                if ($findProduct) {
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => floatval(str_replace('.', '', str_replace('рсд', '', trim($product['selling_price'])))),
                        'purchase_price' => floatval(str_replace('.', '', str_replace('рсд', '', trim($product['purchase_price'])))),
                    ];
                    $price = Price::create($priceData);
                    $percentageChangeSelling = 0;
                    if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                        $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                    }
                    $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                    $percentageChangePurchase = 0;
                    if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                        $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                    }
                    $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                    $findProduct->selling_price = $priceData['selling_price'];
                    $findProduct->purchase_price = $priceData['purchase_price'];
                    $findProduct->save();
                }
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Insignitus Update Prices - 6
     * Function updates products prices from insignitus.rs
     */
    function insignitusUpdatePrices()
    {
        $url = 'https://insignitus.rs/shop/';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('.product-inner')->each(function ($node) {
                $product['url'] = $node->filter('.woo-loop-product__title a')->first()->extract(array('href'))[0];
                if ($node->filter('.mf-product-details .price')->count() > 0) {
                    $product['selling_price'] =  (float)str_replace(',', '.', preg_replace('/[^0-9,]/', '', $node->filter('.mf-product-details .price')->first()->text()));
                } else {
                    $product['selling_price'] =  null;
                }
                if ($node->filter('.mf-product-details .otkupnacena1')->count() > 0) {
                    $product['purchase_price'] = (float)str_replace(',', '.', preg_replace('/[^0-9,]/', '', $node->filter('.mf-product-details .otkupnacena1')->first()->text()));
                } else {
                    $product['purchase_price'] =  null;
                }
                $findProduct = Product::where('url', $product['url'])->first();
                $divider = $this->findDividerForMultipack($findProduct);
                if ($findProduct) {
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => $product['selling_price'] / $divider,
                        'purchase_price' => $product['purchase_price'] / $divider,
                    ];
                    $price = Price::create($priceData);
                    $percentageChangeSelling = 0;
                    if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                        $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                    }
                    $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                    $percentageChangePurchase = 0;
                    if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                        $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                    }
                    $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                    $findProduct->selling_price = $priceData['selling_price'];
                    $findProduct->purchase_price = $priceData['purchase_price'];
                    $findProduct->save();
                }
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Dok Invest Update Prices - 7
     * Update products prices from dokinvest.com
     */
    function dokInvestUpdatePrices()
    {
        $url = 'https://dokinvest.com/zlatne-poluge';
        $url2 = 'https://dokinvest.com/zlatne-kovanice';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('.product-box')->each(function ($node) {
                $product['url'] = 'https://dokinvest.com' . $node->filter('a')->first()->extract(array('href'))[0];
                if ($node->filter('span')->count() > 0) {
                    $product['selling_price'] =  (float)str_replace(',', '.', preg_replace('/[^0-9,]/', '', $node->filter('span')->first()->text()));
                } else {
                    $product['selling_price'] =  null;
                }
                $product['purchase_price'] =  null;
                $findProduct = Product::where('url', $product['url'])->first();
                $divider = $this->findDividerForMultipack($findProduct);
                if ($findProduct) {
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => $product['selling_price'] / $divider,
                        'purchase_price' => $product['purchase_price'] / $divider,
                    ];
                    $price = Price::create($priceData);
                    $percentageChangeSelling = 0;
                    if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                        $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                    }
                    $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                    $percentageChangePurchase = 0;
                    if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                        $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                    }
                    $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                    $findProduct->selling_price = $priceData['selling_price'];
                    $findProduct->purchase_price = $priceData['purchase_price'];
                    $findProduct->save();
                }
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        try {
            $crawler = GoutteFacade::request('GET', $url2);
            $products2 = $crawler->filter('.product-box')->each(function ($node) {
                $product['url'] = 'https://dokinvest.com' . $node->filter('a')->first()->extract(array('href'))[0];
                if ($node->filter('span')->count() > 0) {
                    $product['selling_price'] =  (float)str_replace(',', '.', preg_replace('/[^0-9,]/', '', $node->filter('span')->first()->text()));
                } else {
                    $product['selling_price'] =  null;
                }
                $product['purchase_price'] =  null;
                $findProduct = Product::where('url', $product['url'])->first();
                $divider = $this->findDividerForMultipack($findProduct);
                if ($findProduct) {
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => $product['selling_price'] / $divider,
                        'purchase_price' => $product['purchase_price'] / $divider,
                    ];
                    $price = Price::create($priceData);
                    $percentageChangeSelling = 0;
                    if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                        $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                    }
                    $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                    $percentageChangePurchase = 0;
                    if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                        $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                    }
                    $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                    $findProduct->selling_price = $priceData['selling_price'];
                    $findProduct->purchase_price = $priceData['purchase_price'];
                    $findProduct->save();
                }
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * GVS Srbija Update Prices - 8
     * Products from gvs-srbija.rs
     */
    function gvsSrbijaUpdatePrices()
    {
        $url = 'https://www.gvs-srbija.rs/kupi/zlatne-poluge.html';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('.product-item-info')->each(function ($node) {
                $product['url'] = $node->filter('a')->first()->extract(array('href'))[0];
                if ($node->filter('span')->count() > 0) {
                    $product['selling_price'] =  (float)str_replace(',', '.', preg_replace('/[^0-9,]/', '', $node->filter('.goldFont.tierPrice')->first()->text()));
                } else {
                    $product['selling_price'] =  null;
                }
                $product['purchase_price'] =  null;
                $findProduct = Product::where('url', $product['url'])->first();
                $divider = $this->findDividerForMultipack($findProduct);
                if ($findProduct) {
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => $product['selling_price'] / $divider,
                        'purchase_price' => $product['purchase_price'] / $divider,
                    ];
                    $price = Price::create($priceData);
                    $percentageChangeSelling = 0;
                    if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                        $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                    }
                    $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                    $percentageChangePurchase = 0;
                    if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                        $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                    }
                    $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                    $findProduct->selling_price = $priceData['selling_price'];
                    $findProduct->purchase_price = $priceData['purchase_price'];
                    $findProduct->save();
                }
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        $url = 'https://www.gvs-srbija.rs/kupi/zlatnici.html';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('.product-item-info')->each(function ($node) {
                $product['url'] = $node->filter('a')->first()->extract(array('href'))[0];
                if ($node->filter('span')->count() > 0) {
                    $product['selling_price'] =  (float)str_replace(',', '.', preg_replace('/[^0-9,]/', '', $node->filter('.goldFont.tierPrice')->first()->text()));
                } else {
                    $product['selling_price'] =  null;
                }
                $product['purchase_price'] =  null;
                $findProduct = Product::where('url', $product['url'])->first();
                $divider = $this->findDividerForMultipack($findProduct);
                if ($findProduct) {
                    $priceData = [
                        'product_id' => $findProduct->id,
                        'selling_price' => $product['selling_price'] / $divider,
                        'purchase_price' => $product['purchase_price'] / $divider,
                    ];
                    $price = Price::create($priceData);
                    $percentageChangeSelling = 0;
                    if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                        $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                    }
                    $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                    $percentageChangePurchase = 0;
                    if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                        $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                    }
                    $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                    $findProduct->selling_price = $priceData['selling_price'];
                    $findProduct->purchase_price = $priceData['purchase_price'];
                    $findProduct->save();
                }
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Investiciono zlato 2 - 9
     * Products from investicionozlato.com
     */
    function investicionoZlato2UpdatePrices()
    {
        $eurExchange = getOption('currency_eur_exchange', '117.5');
        $url = 'https://investicionozlato.com/cena-zlatnih-poluga/';

        // Get product URL-s for single pages
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('.elementor-button.elementor-button-link.elementor-size-xl')->each(function ($node) {
                $product['url'] = $node->extract(array('href'))[0];
                return $product;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        // Get product URL-s for prices (because loaded trough iframe)
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $productsPricesUrls = $crawler->filter('iframe')->each(function ($node) {
                $productPrice['price_url'] = $node->attr('src');
                return $productPrice;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        $prods = [];
        foreach ($products as $key => $product) {
            $prods[$key]['url'] = $products[$key]['url'];
            $prods[$key]['price_url'] = $productsPricesUrls[$key]['price_url'];
        }
        foreach ($prods as $k => $prod) {
            // Fetch prices
            try {
                $crawler = GoutteFacade::request('GET', $prod['price_url']);
                $dataPrice = $crawler->filter('.rats')->each(function ($node) use ($eurExchange) {
                    #$price = $node->filter('tr')->last()->text();
                    if (str_contains($node->filter('tr')->last()->text(), 'DIN')) {
                        $price = (float)str_replace(',', '.', preg_replace('/[^0-9,]/', '', $node->filter('tr')->last()->text()));
                    } else {
                        $price = $node->filter('tr')->last()->text();
                        $numericPart = preg_replace('/[^0-9.]/', '', $price);
                        $roundedPrice  = number_format((float)$numericPart, 2, '.', '');
                        $price = number_format((float)$roundedPrice * (floatval($eurExchange) + 1), 2, '.', '');
                    }

                    return $price;
                });
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            $findProduct = Product::where('url', $prod['url'])->first();
            $divider = $this->findDividerForMultipack($findProduct);
            if ($findProduct) {
                $priceData = [
                    'product_id' => $findProduct->id,
                    'selling_price' => (float) $dataPrice[0] / $divider,
                    'purchase_price' => (float) $dataPrice[1] / $divider,
                ];
                $price = Price::create($priceData);
                $percentageChangeSelling = 0;
                if (($findProduct->selling_price && $findProduct->selling_price != 0) && $priceData['selling_price'] != 0) {
                    $percentageChangeSelling = (($findProduct->selling_price - $priceData['selling_price']) / abs($priceData['selling_price'])) * 100;
                }
                $findProduct->selling_price_percentage_change = $percentageChangeSelling;


                $percentageChangePurchase = 0;
                if (($findProduct->purchase_price && $findProduct->purchase_price != 0) && $priceData['purchase_price'] != 0) {
                    $percentageChangePurchase = (($findProduct->purchase_price - $priceData['purchase_price']) / abs($priceData['purchase_price'])) * 100;
                }
                $findProduct->purchase_price_percentage_change = $percentageChangePurchase;

                $findProduct->selling_price = $priceData['selling_price'];
                $findProduct->purchase_price = $priceData['purchase_price'];
                $findProduct->save();
            }
        }
    }

    public function updateEurExchange()
    {
        $eurExchange = $this->getEuroExchangeRate();
        updateOption('currency_eur_exchange', $eurExchange);
    }

    /**
     * Get Euro Exchange Rate
     * Function getting EUR exchange rate
     */
    function getEuroExchangeRate()
    {
        $url = 'https://www.kamatica.com/kursna-lista/nbs';

        // Preuzimanje HTML-a sa stranice
        $response = Http::withoutVerifying()->get($url);
        $html = $response->body();

        // Kreiranje Crawler objekta
        $crawler = new Crawler($html);

        // Selektovanje elementa sa srednjim kursom evra
        $euroExchangeRate = $crawler->filter('#c_EUR')->text();

        // Očišćavanje i formatiranje rezultata
        $euroExchangeRate = str_replace(',', '.', $euroExchangeRate);
        $euroExchangeRate = floatval($euroExchangeRate);

        return $euroExchangeRate;
    }

    /**
     * Find Divider For Multipck
     * Function find if product is multipack and return divider
     */
    function findDividerForMultipack($product)
    {
        $name = $product->name_default;
        $name = str_replace(' ', '', $name);

        $divider = 1;
        if (str_contains($name, '100x1g')) {
            $divider = 100;
        }
        if (str_contains($name, '50x1g')) {
            $divider = 50;
        }
        if (str_contains($name, '20x1g')) {
            $divider = 20;
        }
        if (str_contains($name, '10x1g')) {
            $divider = 10;
        }
        if (str_contains($name, '10x2g')) {
            $divider = 10;
        }
        return $divider;
    }
}
