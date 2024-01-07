<?php

namespace App\Console\Commands;

use App\Http\Controllers\Backend\PriceUpdateController;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\SeoMetaTag;
use App\Notifications\CheckoutNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;


class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

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
        #$this->productNameToUcFirst();
        #$this->updateProductSeo();
        #$this->addColorToProductSlug();
        #$this->reducePrice();
        #$this->renameClik();
        #$order = Order::find(16);
        #Notification::route('mail', 'info@studiozadizajn.rs')
        #    ->notify(new CheckoutNotification($order));
        #$this->removeGoldProducts();
        $uc = new PriceUpdateController();
        #$uc->updatePrices();
        $uc->updateEurExchange();
    }

    public function removeGoldProducts()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $found = DB::table('wp')->where('url', $product->url)->count();
            if ($found > 0) {
                Log::info('DONT DELETE');
            } else {
                if ($product->id < 209) {
                    Log::info("REMOVE - " . $product->url);
                    $product->delete();
                }
            }
        }
    }

    public function renameClik()
    {
        $productMetas = ProductMeta::all();
        foreach ($productMetas as $meta) {
            if ($meta->name == 'Clik') {
                $meta->name = 'Bezbojna';
                $meta->save();
            }
        }
    }

    public function reducePrice()
    {
        $products = Product::all();
        foreach ($products as $product) {
            if ($product->price && $product->price > 0) {
                $product->price = $product->price - 0.01;
                $product->save();
            }
        }
    }

    public function addColorToProductSlug()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $slugSufix = '';
            if ($product->meta->count() == 1 && $product->meta[0]->name == 'Clik') {
                $slugSufix = '';
            }
            if ($product->meta->count() == 1 && $product->meta[0]->name != 'Clik') {
                $slugSufix = '-' . Str::slug($product->meta[0]->name, '-');
            }
            if ($product->meta->count() > 1) {
                $sufixPosition = 0;
                $sufixPosition = rand(1, $product->meta->count()) - 1;
                $slugSufix = '-' . Str::slug($product->meta[$sufixPosition]->name, '-');
            }
            $product->slug = $product->slug . $slugSufix;
            $product->save();
        }
    }



    // Update product SEO
    public function updateProductSeo()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $keywords = [];
            $slugPref = '';
            array_push($keywords, $product->name);
            foreach ($product->categories as $category) {
                if ($category->parent_id) {
                    $slugPref = $category->slug . "-";
                }
                array_push($keywords, $category->name);
            }
            array_push($keywords, 'Reklamni materijal');
            $keywordsString = implode(',', $keywords);
            $color = '';
            Log::info($product->meta);
            foreach ($product->meta as $c) {
                if ($c->name !== 'Clik') {
                    $color = ' - ' . $c->name;
                    break;
                }
            }

            $title = $product->name . $color . " :: ";
            foreach ($product->categories as $category) {
                $title .= $category->name . " :: ";
            }
            $title .= 'Reklamni materijal by Jefimija dizajn';
            $seo = SeoMetaTag::where('model', 'Product')->where('model_id', $product->id)->first();
            if ($seo) {
                $seo->title = $title;
                $seo->keywords = $keywordsString;
                $seo->save();
            }

            $product->slug = $slugPref . $product->slug;
            $product->save();
        }
    }

    // Convert name to ucfirst
    public function productNameToUcFirst()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->name = $this->textToUcFirst($this->textToLowercase($product->name));
            $product->save();
        }
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
