<?php

namespace App\Console\Commands;

use App\Models\File;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductMeta;
use App\Models\SeoMetaTag;
use Carbon\Carbon;
use Hamcrest\Core\IsTypeOf;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Scrape extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape';

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
        $token = $this->getToken();
        #$this->getCategories($token);
        #$this->getProducts($token);
        #$this->getModels($token);
        #$this->getProduct($token, '8073.71');
        #$this->getProduct($token, '2088.90');
        $this->updateQuantity($token);
        #$this->updateProductSubtitle($token);
    }

    public function updateProductSubtitle($token)
    {
        $products = Product::all();
        foreach ($products as $product) {
            $responseModel = Http::asForm()->withToken($token)->timeout(15)->get('http://api.promobay.net/en-US/api/Model?id=' . $product->external_id);
            $rModel = $responseModel->json();
            if (isset($rModel['Description'])) {
                $description = $rModel['Description'];
                $description = $this->textToUcFirst($this->textToLowercase($description));
                $product->subtitle = $description;
                Log::info($product->subtitle);
                $product->save();
            }
        }
    }

    public function updateQuantity($token)
    {
        $products = Product::all();
        foreach ($products as $key => $product) {
            try {
                $responseModel = Http::asForm()->withToken($token)->timeout(15)->get('http://api.promobay.net/en-US/api/Model?id=' . $product->external_id);
                $rModel = $responseModel->json();
                // Find All Colors
                if (isset($rModel['Colors'])) {
                    $productQuantity = 0;
                    foreach ($rModel['Colors'] as $color) {
                        $mColor = [
                            'id' =>  $color['Id'],
                            'name' => $color['Name'],
                            'image' => $color['Image'],
                            'stock' => $color['Sizes'][0]['Product']['Stocks'][0]['Qty'],
                            'external_id' => $color['Sizes'][0]['Product']['Id']
                        ];
                        //array_push($colors, $mColor);
                        $color = ProductMeta::where('name', $color['Name'])->where('product_id', $product->id)->first();
                        if ($color) {
                            $color->stock = $mColor['stock'];
                            $color->external_id = $mColor['external_id'];
                            $color->save();
                        }
                        $productQuantity += $mColor['stock'];
                    }
                }
                $product->quantity = $productQuantity;
                $product->save();
            } catch (\Exception $e) {
                Log::info('ERROR');
            }
        }
    }

    public function getToken()
    {
        $response = Http::asForm()->post('http://api.promobay.net/Token', ['grant_type' => 'password', 'username' => 'jefimija', 'password' => 'Lozinka1#444', 'id' => '']);
        if ($response->successful()) {
            $data = $response->json();
            return $data['access_token'];
        } else {
            return '';
        }
    }

    public function getCategories($token)
    {
        $response = Http::asForm()->withToken($token)->get('http://api.promobay.net/en-US/api/Category');
        $categories = $response->json();
        foreach ($categories as $category) {
            if ($category['Parent'] == '*') {
                $data = [
                    'name' => $category['Name'],
                    'slug' => Str::slug($category['Name']),
                    'external_id' => $category['Id'],
                    'external_service' => 'api.promobay.net',
                    'created_by' => 1,
                ];
                $newCategory = ProductCategory::create($data);
                foreach ($categories as $subCategory) {
                    if ($subCategory['Parent'] == $category['Id']) {
                        if ($subCategory['Name'] == 'Razno') {
                            $pref = $newCategory->name . ' ';
                        } else {
                            $pref = '';
                        }
                        $dataSub = [
                            'name' => $pref . $subCategory['Name'],
                            'slug' => Str::slug($pref . $subCategory['Name']),
                            'external_id' => $subCategory['Id'],
                            'external_service' => 'api.promobay.net',
                            'created_by' => 1,
                            'parent_id' => $newCategory->id
                        ];
                        $newCategorySub = ProductCategory::create($dataSub);
                    }
                }
            }
        }
    }

    // Get All Models
    public function getModels($token)
    {
        $response = Http::asForm()->withToken($token)->timeout(15)->get('http://api.promobay.net/en-US/api/Model');
        $models = $response->json();

        foreach ($models as $key => $model) {
            if (true) {
                $colors = [];
                try {
                    $responseModel = Http::asForm()->withToken($token)->timeout(15)->get('http://api.promobay.net/en-US/api/Model?id=' . $model['Id']);
                    $rModel = $responseModel->json();
                    Log::info($rModel);
                    // Find All Colors

                    /*  if (isset($rModel['Colors'])) {
                        foreach ($rModel['Colors'] as $color) {
                            $mColor = [
                                'id' =>  $color['Id'],
                                'name' => $color['Name'],
                                'image' => $color['Image'],
                                'stock' => $color['Sizes'][0]['Product']['Stocks'][0]['Qty'],
                                'external_id' => $color['Sizes'][0]['Product']['Id']
                            ];
                            array_push($colors, $mColor);
                        }
                    } */
                } catch (\Exception $e) {
                    //Log::info($e);
                    Log::info('ERROR');
                }


                /* $images = [];
                $price = null;
                $ean = null;
                $package = null;
                $limit = null;
                $categoryString = '';
                foreach ($colors as $color) {
                    try {
                        $responseDetails = Http::asForm()->withToken($token)->timeout(15)->get('http://api.promobay.net/en-US/api/Product?id=' .  $model['Id'] . '.' . $color['id']);
                        $productDetails = $responseDetails->json();
                        if (isset($productDetails['Images'])) {
                            foreach ($productDetails['Images'] as $img) {
                                $images[] = $img['Image'];
                            }
                        }
                        if (isset($productDetails['Price'])) {
                            $price = $productDetails['Price'];
                        }
                        if (isset($productDetails['EAN'])) {
                            $ean = $productDetails['EAN'];
                        }
                        if (isset($productDetails['Package'])) {
                            $package = $productDetails['Package'];
                        }
                        if (isset($productDetails['Limit'])) {
                            $limit = $productDetails['Limit'];
                        }
                        if (isset($productDetails['SubCategory']['Id'])) {
                            $categoryString = $productDetails['SubCategory']['Id'];
                        } else {
                            if (isset($productDetails['Category']['Id'])) {
                                $categoryString = $productDetails['Category']['Id'];
                            }
                        }
                    } catch (\Exception $e) {
                        Log::info('ERROR');
                    }
                }

                $catArray = [];
                if ($categoryString !== '') {
                    $categoryArray = explode(' - ', $categoryString);
                    if (count($categoryArray) > 1) {
                        $catArray[] = ProductCategory::where('external_id', $categoryString)->first()['id'];
                        $catArray[] = ProductCategory::where('external_id', $categoryArray[0])->first()['id'];
                    }
                }

                $data = [
                    'external_id' => $model['Id'],
                    'external_service' => 'promobay.com',
                    'name' => $model['Name'],
                    'slug' => Str::slug($model['Name'], '-'),
                    'description' => isset($model['Description']) ? '<p>' . $model['Description'] . '</p><br>' . $model['Description2'] : '',
                    'currency' => 'EUR',
                    'price' => $price,
                    'ean' => $ean,
                    'status' => 'published',
                    'package' => $package,
                    'limit_quantity' => $limit,
                    'created_by' => 1,
                    //'images' => $images,
                    //'colors' => $colors
                ]; */

                #$product = Product::create($data);
                #$product->categories()->sync($catArray);

                // Color Meta
                /* foreach ($colors as $key => $color) {
                    $colorImage = file_get_contents($color['image']);
                    $cSlug = Str::slug($color['name'], '-');
                    $name = date('Y') . "/" . date('m') . '/' .  $model['Id'] . '.' . $color['id'] . '-' . $cSlug . '.jpg';
                    Storage::disk('public')->put($name, $colorImage);
                    $imageData = [
                        'name' => $model['Id'] . '.' . $color['id'] . '-' . $cSlug . '.jpg',
                        'path' => $name,
                        'path_original' => $color['image'],
                        'size' => 0,
                        'mime_type' => 'image/jpeg',
                        'extension' => 'jpg',
                        'media_type' => 'image',
                        'created_by' => 1
                    ];
                    $imageFileColor = File::create($imageData);
                    // Add to meta
                    $medaData = [
                        'product_id' => $product->id,
                        'type' => 'Boja',
                        'name' => $color['name'],
                        'value' => $imageFileColor->path,
                        'stock' => $color['stock'],
                        'external_id' => $color['external_id']
                    ];
                    $seoMeta = ProductMeta::create($medaData);
                }

                foreach ($images as $key => $img) {
                    $url = $img;
                    $contents = file_get_contents($url);
                    if ($key > 0) {
                        $sub = '-' . $key;
                    } else {
                        $sub = '';
                    }
                    $name = date('Y') . "/" . date('m') . '/' . $data['slug'] . $sub . '.jpg';
                    Storage::disk('public')->put($name, $contents);
                    $imageData = [
                        'name' => $data['slug'] . $sub . '.jpg',
                        'path' => $name,
                        'path_original' => $url,
                        'size' => 0,
                        'mime_type' => 'image/jpeg',
                        'extension' => 'jpg',
                        'media_type' => 'image',
                        'created_by' => 1
                    ];
                    $imageFile = File::create($imageData);
                    $product->files()->attach($imageFile->id);
                }

                $keywords = ''; */

                /* $dataSeo = [
                    'model' => 'Product',
                    'model_id' => $product->id,
                    'title' => $data['name'],
                    'description' => strip_tags($data['description']),
                    'keywords' => $keywords
                ]; */
                #$seo = SeoMetaTag::create($dataSeo);
                Log::info('DONE');
            }
        }
    }

    public function getProducts($token)
    {
        $response = Http::asForm()->withToken($token)->get('http://api.promobay.net/en-US/api/Product');
        $products = $response->json();
        foreach ($products as $product) {
            $responseDetails = Http::asForm()->withToken($token)->get('http://api.promobay.net/en-US/api/Product?id=' . $product['Id']);
            $productDetails = $responseDetails->json();

            $data = [
                'name' => $productDetails['Name'],
                'slug' => Str::slug($productDetails['Name'], '-'),
                'description' => isset($productDetails['Model']['Description']) ? $productDetails['Model']['Description'] : '',
                'price' => $productDetails['Price'],
                'currency' => 'EUR',
                'status' => 'published',
                'ean' => $productDetails['EAN'],
                'quantity' => $productDetails['Stocks'][0]['Qty'],
                'package' => $productDetails['Package'],
                'limit_quantity' => $productDetails['Limit'],
                'external_id' => $productDetails['Id'],
                'external_service' => 'promobay.com'
            ];

            $keywords = '';
            $dataSeo = [
                'model' => 'Product',
                'title' => $productDetails['Name'],
                'description' => isset($productDetails['Model']['Description']) ? $productDetails['Model']['Description'] : '',
                'keywords' => $keywords
            ];

            Log::info($dataSeo);

            /* if (isset($product['Model']['Id']) && gettype(($product['Model']['Id']) == 'array')) {
                $responseColors = Http::asForm()->withToken($token)->get('http://api.promobay.net/en-US/api/Model?id=' . $product['Model']['Id']);
                $productColors = $responseColors->json();
                Log::info($productColors);
            } */
        }
    }

    public function getProduct($token, $productId)
    {
        $responseDetails = Http::asForm()->withToken($token)->get('http://api.promobay.net/en-US/api/Product?id=' . $productId);
        $productDetails = $responseDetails->json();
        Log::info($productDetails);
    }

    function textToLowercase($text)
    {
        $lowercase = mb_strtolower($text, 'UTF-8');
        return $lowercase;
    }

    function textToUcFirst($text)
    {
        if (empty($text)) {
            return $text;
        }
        $firstSmallLetter = mb_substr($text, 0, 1, 'UTF-8');
        $firstBigLetter = mb_strtoupper($firstSmallLetter, 'UTF-8');
        $convertedText = $this->mb_substr_replace($text, $firstBigLetter, 0, 1, 'UTF-8');
        return $convertedText;
    }

    // Funkcija za zamenu slova u stringu sa podrškom za UTF-8
    public function mb_substr_replace($string, $replacement, $start, $length, $encoding)
    {
        $before = mb_substr($string, 0, $start, $encoding);
        $after = mb_substr($string, $start + $length, NULL, $encoding);
        $newString = $before . $replacement . $after;
        return $newString;
    }
}
