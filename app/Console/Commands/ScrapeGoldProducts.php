<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductCategory;
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
        #$this->goldenSpaceProducts();
        $this->zlatoMojeProducts();

        #$pric = $this->fetchInvesticionoZlatoItemPrice('https://investiciono-zlato.rs/zlatne-poluge-20-grama-10-x-2g.html');
        #Log::info($pric);
    }

    function fetchZlatniStandard()
    {
        $data = [];
        $data[0]['name'] = 'Zlatne pločice';
        $data[0]['slug'] = Str::slug($data[0]['name'], '-');
        $data[0]['url'] = 'https://zlatnistandard.rs/kategorija/zlatne-plocice/';
        $data[0]['categories'] = [];
        $data[1]['name'] = 'Zlatne poluge';
        $data[1]['slug'] = Str::slug($data[1]['name'], '-');
        $data[1]['url'] = 'https://zlatnistandard.rs/kategorija/zlatne-poluge/';
        $data[1]['categories'] = [];
        $data[2]['name'] = 'Zlatni dukati';
        $data[2]['slug'] = Str::slug($data[2]['name'], '-');
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

        foreach ($data as $item) {
            $cParentData = [
                'name' => $item['name'],
                'slug' => $item['slug'],
                'description' => $item['url'],
            ];
            $categoryParent = ProductCategory::create($cParentData);
            foreach ($item['categories'] as $child) {
                $cChildData = [
                    'name' => $child['name'],
                    'slug' => $child['slug'],
                    'description' =>  $child['url'],
                    'parent_id' =>  $categoryParent->id,
                ];
                $categoryChild = ProductCategory::create($cChildData);
                foreach ($child['items'] as $prod) {
                    $declaration = '';
                    if (gettype($prod['declaration']) == 'array') {
                        foreach ($prod['declaration'] as $dec) {
                            $declaration .= '<p>' . $dec . '</p>';
                        }
                    } else {
                        $declaration = $prod['declaration'];
                    }
                    $productData = [
                        'name' => $prod['name'],
                        'slug' => $prod['slug'],
                        'url' => $prod['url'],
                        'company' => $prod['company'],
                        'description' =>  $prod['description'],
                        'declaration' =>  $declaration,
                        'short' =>  $prod['short'],
                    ];
                    $product = Product::create($productData);
                    $product->categories()->attach($categoryChild->id);
                }
            }
        }
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

    /**
     * Investiciono zlato
     * Function fetch products from https://investiciono-zlato.rs
     */
    function fetchInvesticionoZlato()
    {
        $data = [];
        $data[0]['name'] = 'Zlatne pločice';
        $data[0]['url'] = 'https://investiciono-zlato.rs/zlatne-plocice';
        $data[0]['products'] = [];
        $data[1]['name'] = 'Zlatne poluge';
        $data[1]['url'] = 'https://investiciono-zlato.rs/zlatne-poluge';
        $data[1]['products'] = [];
        $data[2]['name'] = 'Zlatne dukati';
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

        foreach ($data as $da) {

            foreach ($da['products'] as $product) {
                $productData = [
                    'name' => $product['name'],
                    'slug' => Str::slug($product['name'], '-') . '-investiciono-zlato.rs',
                    'url' => $product['url'],
                    'company' => 'investiciono-zlato.rs',
                    'description' =>  $product['description'],
                    'declaration' =>  '',
                    'short' =>  '',
                    'selling_price' => floatval(str_replace('.', '', str_replace('din', '', trim($product['selling_price'])))),
                    'purchase_price' => floatval(str_replace('.', '', str_replace('din', '', trim($product['purchase_price'])))),
                ];

                $product = Product::create($productData);
                $categoryID = $this->findCategory($product['name']);
                if ($categoryID) {
                    $product->categories()->attach($categoryID);
                }
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

    /**
     * Tavex 
     * Products from tavex.rs
     */
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
        foreach ($products as $prod) {
            $productData = [
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name'], '-') . '-tavex.rs',
                'url' => $prod['url'],
                'company' => 'tavex.rs',
                'description' =>  '',
                'declaration' =>  '',
                'short' =>  '',
                'selling_price' => floatval(str_replace('.', '', str_replace('din', '', trim($prod['selling_price'])))),
                'purchase_price' => floatval(str_replace('.', '', str_replace('din', '', trim($prod['purchase_price'])))),
            ];

            $product = Product::create($productData);
            $categoryID = $this->findCategory($product['name']);
            if ($categoryID) {
                $product->categories()->attach($categoryID);
            }
        }
    }

    /**
     * Golden Space
     * Products from golden-space.rs
     */
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
                return $product;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        Log::info($products);
        foreach ($products as $prod) {
            $productData = [
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name'], '-') . '-golden-space.rs',
                'url' => $prod['url'],
                'company' => 'golden-space.rs',
                'description' =>  '',
                'declaration' =>  '',
                'short' =>  '',
                'selling_price' => floatval(str_replace('.', '', str_replace('RSD', '', trim($prod['selling_price'])))),
                'purchase_price' => floatval(str_replace('.', '', str_replace('RSD', '', trim($prod['purchase_price'])))),
            ];

            $product = Product::create($productData);
            $categoryID = $this->findCategory($product['name']);
            if ($categoryID) {
                $product->categories()->attach($categoryID);
            }
        }
    }

    /**
     * Zlato Moje
     * Products from zlatomoje.rs
     */
    function zlatoMojeProducts()
    {
        $url = 'https://www.zlatomoje.rs/';
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $products = $crawler->filter('section li[data-hook="product-list-grid-item"]')->each(function ($node) {
                Log::info($node->text());
                $product['url'] = $node->filter('[data-hook="product-item-product-details-link"]')->first()->extract(array('href'))[0];
                $product['name'] = $node->filter('[data-hook="product-item-name"]')->first()->text();
                $product['slug'] = Str::slug($product['name'], '-');
                $product['selling_price'] =  $node->filter('[data-hook="product-item-price-to-pay"]')->first()->text();
                $product['purchase_price']  = null;
                return $product;
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        foreach ($products as $prod) {
            $productData = [
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name'], '-') . '-zlatomoje.rs',
                'url' => $prod['url'],
                'company' => 'zlatomoje.rs',
                'description' =>  '',
                'declaration' =>  '',
                'short' =>  '',
                'selling_price' => floatval(str_replace(',00', '', str_replace('.', '', str_replace('РСД', '', trim($prod['selling_price']))))),
                'purchase_price' => floatval(str_replace(',00', '', str_replace('.', '', str_replace('РСД', '', trim($prod['purchase_price']))))),
            ];

            $product = Product::create($productData);
            $categoryID = $this->findCategory($product['name']);
            if ($categoryID) {
                $product->categories()->attach($categoryID);
            }
        }
        Log::info($products);
    }

    function findCategory($string)
    {
        $category = null;
        if (str_contains($string, '1 gram') || str_contains($string, '1gram') || str_contains($string, '1g') || str_contains($string, '1 g')) {
            $category = ProductCategory::where('name', 'LIKE', '%1g%')->first();
        }
        if (str_contains($string, '2 gram') || str_contains($string, '2gram') || str_contains($string, '2g') || str_contains($string, '2 g')) {
            $category = ProductCategory::where('name', 'LIKE', '%2g%')->first();
        }
        if (str_contains($string, '5 gram') || str_contains($string, '5gram') || str_contains($string, '5g') || str_contains($string, '5 g')) {
            $category = ProductCategory::where('name', 'LIKE', '%5g%')->first();
        }
        if (str_contains($string, '10 gram') || str_contains($string, '10gram') || str_contains($string, '10g') || str_contains($string, '10 g')) {
            $category = ProductCategory::where('name', 'LIKE', '%10g%')->first();
        }
        if (str_contains($string, '20 gram') || str_contains($string, '20gram') || str_contains($string, '20g') || str_contains($string, '20 g')) {
            $category = ProductCategory::where('name', 'LIKE', '%20g%')->first();
        }
        if (str_contains($string, '1 oz') || str_contains($string, '1oz') || str_contains($string, '1unc') || str_contains($string, '1 unc')) {
            $category = ProductCategory::where('name', 'LIKE', '%1 unca%')->first();
        }
        if (str_contains($string, '50 gram') || str_contains($string, '50gram') || str_contains($string, '50g') || str_contains($string, '50 g')) {
            $category = ProductCategory::where('name', 'LIKE', '%50g%')->first();
        }
        if (str_contains($string, '100 gram') || str_contains($string, '100gram') || str_contains($string, '100g') || str_contains($string, '100 g')) {
            $category = ProductCategory::where('name', 'LIKE', '%100g%')->first();
        }
        if (str_contains($string, '100 gram') || str_contains($string, '100gram') || str_contains($string, '100g') || str_contains($string, '100 g')) {
            $category = ProductCategory::where('name', 'LIKE', '%100g%')->first();
        }
        if ($category) {
            return $category->id;
        } else {
            return null;
        }
    }
}
