<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SeoMetaTag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Weidner\Goutte\GoutteFacade;

class Updating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:updating';

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
        #$this->updateDefaultData();
        #$this->updateCompany();
        #$this->updateNames();
        #$this->updateSlug();
        #$this->updateProductCategorySeo();
        $this->updateProductsImage();
    }

    public function updateProductsImage()
    {
        $products = Product::all();
        foreach ($products as $product) {
            #Log::info($product->url);
            $imageUrl = $this->getProductImageUrl($product->url);
            Log::info('Image url:' . $imageUrl);
            $product->product_image_url = $imageUrl;
            $product->save();
        }
    }

    //Get product image URL
    public function getProductImageUrl($url)
    {
        // 1 - investiciono-zlato.rs
        if (str_contains($url, 'https://investiciono-zlato.rs/')) {
            $price = [];
            try {
                $crawler = GoutteFacade::request('GET', $url);
                $price = $crawler->filter('.product.media img')->first()->extract(array('src'))[0];
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

        // 2 - tavex.rs
        if (str_contains($url, 'https://tavex.rs/')) {
            $images = [];
            try {
                $crawler = GoutteFacade::request('GET', $url);
                $image = $crawler->filter('.carousel__slide-img')->first()->extract(['data-srcset'])[0];
                $arrImage = explode('.jpg', $image);
                $image = $arrImage[0] . '.jpg';
                return $image;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            if (count($images) > 0) {
                return $images[0][0];
            } else {
                return '';
            }
        }

        // 3 - golden-space.rs
        if (str_contains($url, 'https://golden-space.rs/')) {
            $images = [];
            try {
                $crawler = GoutteFacade::request('GET', $url);
                $image = $crawler->filter('.woocommerce-product-gallery__image img')->first()->extract(['src'])[0];
                return $image;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            if (count($images) > 0) {
                return $images[0][0];
            } else {
                return '';
            }
        }

        // 4 - www.zlatomoje.rs
        if (str_contains($url, 'https://www.zlatomoje.rs/')) {
            $images = [];
            try {
                $crawler = GoutteFacade::request('GET', $url);
                $image = $crawler->filter('#get-image-item-id img')->first()->extract(['src'])[0];
                $imageArr = explode('/v1/', $image);
                $image = $imageArr[0];
                return $image;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            if (count($images) > 0) {
                return $images[0][0];
            } else {
                return '';
            }
        }

        // 5 - www.kupizlato.com
        if (str_contains($url, 'https://www.kupizlato.com/')) {
            $images = [];
            try {
                $crawler = GoutteFacade::request('GET', $url);
                $image = $crawler->filter('.wp-post-image')->first()->extract(['src'])[0];
                return $image;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            if (count($images) > 0) {
                return $images[0][0];
            } else {
                return '';
            }
        }

        // 6 - insignitus.rs
        if (str_contains($url, 'https://insignitus.rs/')) {
            $images = [];
            try {
                $crawler = GoutteFacade::request('GET', $url);
                $image = $crawler->filter('.woocommerce-product-gallery__wrapper img')->first()->extract(['src'])[0];
                return $image;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            if (count($images) > 0) {
                return $images[0][0];
            } else {
                return '';
            }
        }

        // 7 - dokinvest.com
        if (str_contains($url, 'https://dokinvest.com/')) {
            $images = [];
            try {
                $crawler = GoutteFacade::request('GET', $url);
                $image = 'https://dokinvest.com/' . $crawler->filter('.img-responsive')->first()->extract(['src'])[0];
                return $image;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            if (count($images) > 0) {
                return $images[0][0];
            } else {
                return '';
            }
        }

        // 8 - www.gvs-srbija.rs
        if (str_contains($url, 'https://www.gvs-srbija.rs/')) {
            $images = [];
            try {
                $crawler = GoutteFacade::request('GET', $url);
                $image = $crawler->filter('body #maindiv #mainContainerRight img')->first()->extract(['src'])[0];
                return $image;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            if (count($images) > 0) {
                return $images[0][0];
            } else {
                return '';
            }
        }

        // 9 - investicionozlato.com
        if (str_contains($url, 'https://investicionozlato.com/')) {
            $images = [];
            try {
                $crawler = GoutteFacade::request('GET', $url);
                $image = $crawler->filter('.attachment-full.size-full')->first()->extract(['srcset'])[0];
                $arrImage = explode('.jpg', $image);
                $image = $arrImage[0] . '.jpg';
                return $image;
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            if (count($images) > 0) {
                return $images[0][0];
            } else {
                return '';
            }
        }

        return '';
    }

    public function updateProductSeo()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $seoData = [
                'model' => 'Product',
                'model_id' => $product->id,
                'title' => ucwords(str_replace("-", " ", $product->slug))
            ];
            $seo = SeoMetaTag::create($seoData);
        }
    }

    public function updateProductCategorySeo()
    {
        $productCategories = ProductCategory::all();
        foreach ($productCategories as $category) {
            $seoData = [
                'model' => 'ProductCategory',
                'model_id' => $category->id,
                'title' => ucfirst(str_replace("-", " ", $category->slug))
            ];
            $seo = SeoMetaTag::create($seoData);
        }
    }

    public function updateSlug()
    {
        $products = Product::with(['company'])->get();
        foreach ($products as $product) {
            $slug = $product->slug . '-' . Str::slug($product->company->name);
            $product->slug = $slug;

            if ($product->quantity_type == 'MULTI') {
                $product->name = $product->name . '- Multi';
            }

            $product->save();
        }
    }

    public function updateCompany()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $comp = Company::where('url', 'LIKE', '%' . $product->company . '%')->first();
            $product->company_id = $comp->id;
            $product->save();
        }
    }

    public function updateDefaultData()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->name_default = $product->name;
            $product->slug_default = $product->slug;
            $product->save();
        }
    }

    public function updateNames()
    {
        $string = 'x';
        // Get all names
        $products = Product::where('name', 'LIKE', '%' . $string . '%')->get();
        $products = Product::whereHas('categories', function ($qc) {
            $qc->where('slug', 'LIKE', '%zlatne-poluge%')
                ->orWhere('slug', 'LIKE', '%zlatne-plocice%');
        })->get();

        foreach ($products as $product) {
            $product = $this->generateName($product);
            $product->save();
        }
    }


    public function generateName($product)
    {
        $producer = '';
        $producerShort = '';
        if (str_contains(strtolower($product->name), 'hafner')) {
            $producer = 'C.Hafner';
            $producerShort = 'CH';
            $nData = $this->findWeight($product->name, $producer, $producerShort);
        } else if (str_contains(strtolower($product->name), 'heraeus')) {
            $producer = 'Argor Heraeus';
            $producerShort = 'AH';
            $nData = $this->findWeight($product->name, $producer, $producerShort);
        } else if (str_contains(strtolower($product->name), 'heimerle')) {
            $producer = 'Heimerle + Meule';
            $producerShort = 'HM';
            $nData = $this->findWeight($product->name, $producer, $producerShort);
        } else if (str_contains(strtolower($product->name), 'valcambi')) {
            $producer = 'Valcambi Suisse';
            $producerShort = 'VS';
            $nData = $this->findWeight($product->name, $producer, $producerShort);
        } else if (str_contains(strtolower($product->company), 'insignitus')) {
            $producer = 'Argor Heraeus';
            $producerShort = 'AH';
            $nData = $this->findWeight($product->name, $producer, $producerShort);
        } else {
            $producer = 'Argor Heraeus';
            $producerShort = 'AH';
            $nData = $this->findWeight($product->name, $producer, $producerShort);
        }

        $product->producer = $producer;
        $product->producer_short = $producerShort;
        $product->name_default = $product->name;
        $product->name = $nData['name'];
        $product->slug_default = $product->slug;
        $product->slug = $nData['slug'];
        $product->unique_key = $nData['key'];
        $product->quantity_type = $nData['qtype'];

        return $product;
    }

    public function findWeight($name, $producer, $producerShort)
    {
        $weight['name'] = '';
        $weight['slug'] = '';
        $weight['key'] = '';
        $weight['qtype'] = 'SINGLE';
        $typeQty = 'SINGLE';

        if (str_contains($name, 'x')) {
            $weight['qtype'] = 'MULTI';
            $typeQty = 'MULTI';
        }
        if (str_contains($name, '1 unca') || str_contains($name, '1unca') || str_contains($name, '1 oz') || str_contains($name, '1oz') || str_contains($name, '1 unza')) {
            $weight['name'] = '1unca zlata | ' . $producer;
            $weight['slug'] = 'zlatne-poluge-' . Str::slug($producer) . '-1unca';
            $weight['key'] = $producerShort . '1UBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else if (str_contains($name, '1g') || str_contains($name, '1 gram') || str_contains($name, '1gram')) {
            $weight['name'] = '1g zlata | ' . $producer;
            $weight['slug'] = 'zlatne-plocice-' . Str::slug($producer) . '-1g';
            $weight['key'] = $producerShort . '1GBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else if (str_contains($name, '2g') || str_contains($name, '2 gram') || str_contains($name, '2,0g')) {
            $weight['name'] = '2g zlata | ' . $producer;
            $weight['slug'] = 'zlatne-plocice-' . Str::slug($producer) . '-2g';
            $weight['key'] = $producerShort . '2GBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else if (str_contains($name, '5g') || str_contains($name, '5 gram') || str_contains($name, '5,0g')) {
            $weight['name'] = '5g zlata | ' . $producer;
            $weight['slug'] = 'zlatne-plocice-' . Str::slug($producer) . '-5g';
            $weight['key'] = $producerShort . '5GBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else if (str_contains($name, '10g') || str_contains($name, '10 gram') || str_contains($name, '10,0g')) {
            $weight['name'] = '10g zlata | ' . $producer;
            $weight['slug'] = 'zlatne-plocice-' . Str::slug($producer) . '-10g';
            $weight['key'] = $producerShort . '10GBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else if (str_contains($name, '20g') || str_contains($name, '20 gram') || str_contains($name, '20,0g')) {
            $weight['name'] = '20g zlata | ' . $producer;
            $weight['slug'] = 'zlatne-plocice-' . Str::slug($producer) . '-20g';
            $weight['key'] = $producerShort . '20GBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else if (str_contains($name, '100g') || str_contains($name, '100 gram')) {
            $weight['name'] = '100g zlata | ' . $producer;
            $weight['slug'] = 'zlatne-poluge-' . Str::slug($producer) . '-100g';
            $weight['key'] = $producerShort . '100GBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else if (str_contains($name, '250g') || str_contains($name, '250 gram')) {
            $weight['name'] = '250g zlata | ' . $producer;
            $weight['slug'] = 'zlatne-poluge-' . Str::slug($producer) . '-250g';
            $weight['key'] = $producerShort . '250GBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else if (str_contains($name, '500g') || str_contains($name, '500 gram')) {
            $weight['name'] = '500g zlata | ' . $producer;
            $weight['slug'] = 'zlatne-poluge-' . Str::slug($producer) . '-500g';
            $weight['key'] = $producerShort . '500GBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else if (str_contains($name, '50g') || str_contains($name, '50 gram')) {
            $weight['name'] = '50g zlata | ' . $producer;
            $weight['slug'] = 'zlatne-poluge-' . Str::slug($producer) . '-50g';
            $weight['key'] = $producerShort . '50GBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else if (str_contains($name, '1000g') || str_contains($name, '1000 gram') || str_contains($name, '1 kg')) {
            $weight['name'] = '1000g zlata | ' . $producer;
            $weight['slug'] = 'zlatne-poluge-' . Str::slug($producer) . '-1000g';
            $weight['key'] = $producerShort . '1000GBAR_' . $typeQty . '_BASIC';
            return $weight;
        } else {
            return $weight;
        }
    }
}
