<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Weidner\Goutte\GoutteFacade;
use Illuminate\Support\Str;

class ScrapeGoldProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:gold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        #$this->fetchZlatniStandard();
        #$this->fetchInvesticionoZlato();

        #$this->tavexProducts();
        $this->goldenSpaceProducts();

        #$pric = $this->fetchInvesticionoZlatoItemPrice('https://investiciono-zlato.rs/zlatne-poluge-20-grama-10-x-2g.html');
        #Log::info($pric);
    }

    function fetchZlatniStandard()
    {
        $data = [];
        $data[0]['url'] = 'https://zlatnistandard.rs/kategorija/zlatne-plocice/';
        $data[0]['categories'] = [];
        $data[1]['url'] = 'https://zlatnistandard.rs/kategorija/zlatne-poluge/';
        $data[1]['categories'] = [];
        $data[2]['url'] = 'https://zlatnistandard.rs/kategorija/zlatni-dukati/';
        $data[2]['categories'] = [];

        foreach ($data as $key => $d) {
            $categories = [];
            try {
                $crawler = GoutteFacade::request('GET', $d['url']);
                $categories[] = $crawler->filter('.product-category')->each(function ($node) {
                    $category['name'] = preg_replace('/\([^)]+\)/', '', $node->children()->text());
                    $category['slug'] = Str::slug($category['name'], '-');
                    $category['url'] = $node->children()->extract(array('href'))[0];
                    $category['items'] = [];
                    return $category;
                });
                $data[$key]['categories'] = $categories[0];
                foreach ($data[$key]['categories'] as $k => $category) {
                    $data[$key]['categories'][$k]['items'] = $this->fetchZlatniStandardCategoryItems($category['url']);
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }

        Log::info($data);
    }

    function fetchZlatniStandardCategoryItems($url)
    {
        $items = [];
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $items[] = $crawler->filter('.type-product')->each(function ($node) {
                $item['name'] = $node->filter('.woocommerce-loop-product__title')->first()->text();
                $item['slug'] = Str::slug($item['name'], '-');
                $item['url'] = $node->children()->extract(array('href'))[0];
                $item['company'] = 'zlatnistandard.rs';
                $details = $this->fetchZlatniStandardCategoryItemsDetails($item['url']);
                $item['description'] = $details[0]['description'];
                $declaration = $this->fetchZlatniStandardCategoryItemsDeclaration($item['url']);
                $item['declaration'] = $declaration[0];
                $item['short'] = $this->fetchZlatniStandardCategoryItemsShortDesc($item['url']);
                return $item;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return $items[0];
    }

    function fetchZlatniStandardCategoryItemsDetails($url)
    {
        $details = [];
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $details[] = $crawler->filter('.elementor-tabs-content-wrapper')->each(function ($node) {
                $detail['description'] = $node->children('.elementor-tab-content')->text();
                return $detail;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return $details[0];
    }

    function fetchZlatniStandardCategoryItemsDeclaration($url)
    {
        $declaration = [];
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $table = $crawler->filter('table')->first();

            $declaration[] = $table->filter('tr')->each(function ($row, $i) {
                #Log::info($row->text());
                return $row->text();
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return $declaration;
    }

    function fetchZlatniStandardCategoryItemsShortDesc($url)
    {
        $desc = '';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $desc = $crawler->filter('.woocommerce-product-details__short-description')->first()->text();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return $desc;
    }

    function fetchInvesticionoZlato()
    {
        $data = [];
        $data[0]['url'] = 'https://investiciono-zlato.rs/zlatne-plocice';
        $data[0]['products'] = [];
        $data[1]['url'] = 'https://investiciono-zlato.rs/zlatne-poluge';
        $data[1]['products'] = [];
        $data[2]['url'] = 'https://investiciono-zlato.rs/dukati';
        $data[2]['products'] = [];

        foreach ($data as $key => $d) {
            $products = [];
            try {
                $crawler = GoutteFacade::request('GET', $d['url']);
                $products[] = $crawler->filter('.product-item')->each(function ($node) {
                    $product['url'] = $node->filter('.product-item-link')->extract(array('href'))[0];
                    $product['name'] = $node->filter('.product-item-link')->text();
                    if ($product['url'] !== '') {
                        return $product;
                    }
                });
                $data[$key]['products'] = $products[0];
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
        foreach ($data as $k => $d) {
            $newProducts = [];
            foreach ($d['products'] as $pKey => $product) {
                if (gettype($product)  == 'array') {
                    array_push($newProducts, $product);
                }
            }
            $data[$k]['products'] = $newProducts;
        }

        foreach ($data as $k => $d) {
            foreach ($d['products'] as $pKey => $product) {
                $data[$k]['products'][$pKey]['description'] = $this->fetchInvesticionoZlatoItemsDescription($product['url']);
                $data[$k]['products'][$pKey]['selling_price'] = $this->fetchInvesticionoZlatoItemPrice($product['url']);
                $data[$k]['products'][$pKey]['purchase_price'] = $this->fetchInvesticionoZlatoItemPurchasePrice($product['url']);
            }
        }


        Log::info($data);
    }

    function fetchInvesticionoZlatoItemsDescription($url)
    {
        $details = [];
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $details[] = $crawler->filter('.product-info-main')->each(function ($node) {
                $description = $node->children('.product.attribute.overview')->text();
                return $description;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        if (count($details) > 0) {
            return $details[0][0];
        } else {
            return '';
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

    function fetchInvesticionoZlatoItemPrice($url)
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


    function tavexProducts()
    {
        $url = 'https://tavex.rs/zlato/';

        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('.product--gold')->each(function ($node) {

                $product['url'] = $node->extract(array('href'))[0];
                $product['name'] = $node->children('.product__meta .product__meta-box .product__title')->text();
                $product['slug'] = Str::slug($product['name'], '-');
                $priceCheck = $node->filter('.product__meta .product__meta-box .product__prices .product__price--single .product__price-value')->count();
                $product['selling_price'] = null;
                if ($priceCheck > 0) {
                    $product['selling_price'] = $node->filter('.product__meta .product__meta-box .product__prices .product__price--single .product__price-value')->first()->text();
                    $product['selling_price'] = str_replace('din', ' din', str_replace(' ', '', $product['selling_price']));
                }
                $purchasePriceCheck = $node->filter('.product__meta .product__meta-box .product__prices .product__price--buy .product__price-value')->count();
                $product['purchase_price'] = null;
                if ($purchasePriceCheck > 0) {
                    $product['purchase_price'] = $node->filter('.product__meta .product__meta-box .product__prices .product__price--buy .product__price-value')->first()->text();
                    $product['purchase_price'] = str_replace('din', ' din', str_replace(' ', '', $product['purchase_price']));
                }
                $product['company'] = 'tavex.rs';
                return $product;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        Log::info($products);
    }

    function goldenSpaceProducts()
    {
        $url = 'https://golden-space.rs/investiciono-zlato/';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('.elementor-heading-title.elementor-size-default')->each(function ($node) {
                $product['url'] = $node->children('a')->extract(array('href'))[0];
                $product['name'] = str_replace(["\xE2\x80\x8E", "\xE2\x80\x8F"], "", $node->text());
                $product['slug'] = Str::slug($product['name'], '-');
                $product['selling_price'] = $node->closest('.elementor-element-populated')->filter('.elementor-widget-text-editor .woocommerce-Price-amount')->first()->text();
                $product['purchase_price'] = $node->closest('.elementor-element-populated')->filter('.elementor-widget-text-editor .woocommerce-Price-amount')->last()->text();
                $product['company'] = 'golden-space.rs';
                return $product;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        Log::info($products);
    }
}
