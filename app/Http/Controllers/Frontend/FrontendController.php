<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\ProductAction;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    protected $theme = 'gold';

    public function __construct()
    {
        $this->theme = getOption('setting_theme_active_opt', 'gold');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get()->take(3);

        $goldenPlates[0]['name'] = '1g';
        $goldenPlates[0]['description'] = '1 grama';
        $goldenPlates[0]['slug'] = 'zlatne-plocice-1g';
        $goldenPlates[0]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '1g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);
        $goldenPlates[1]['name'] = '2g';
        $goldenPlates[1]['description'] = '2 grama';
        $goldenPlates[1]['slug'] = 'zlatne-plocice-2g';
        $goldenPlates[1]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '2g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenPlates[2]['name'] = '5g';
        $goldenPlates[2]['description'] = '5 grama';
        $goldenPlates[2]['slug'] = 'zlatne-plocice-5g';
        $goldenPlates[2]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '5g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenPlates[3]['name'] = '10g';
        $goldenPlates[3]['description'] = '10 grama';
        $goldenPlates[3]['slug'] = 'zlatne-plocice-10g';
        $goldenPlates[3]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '10g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenPlates[4]['name'] = '20g';
        $goldenPlates[4]['description'] = '20 grama';
        $goldenPlates[4]['slug'] = 'zlatne-plocice-20g';
        $goldenPlates[4]['products'] = Product::with(['company'])->whereHas('categories', function ($q) {
            $q->where('name', '20g');
        })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenPlates[5]['name'] = 'Multi proizvod';
        $goldenPlates[5]['description'] = '1g multi proizvod';
        $goldenPlates[5]['slug'] = 'multi-proizvod';
        $goldenPlates[5]['products'] = Product::with(['company'])->whereHas('categories', function ($q) {
            $q->where('name', 'multi proizvod');
        })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[0]['name'] = '1unca';
        $goldenBars[0]['description'] = '1 unca';
        $goldenBars[0]['slug'] = 'zlatne-poluge-1unca';
        $goldenBars[0]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '1unca');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[1]['name'] = '50g';
        $goldenBars[1]['description'] = '50 grama';
        $goldenBars[1]['slug'] = 'zlatne-poluge-50g';
        $goldenBars[1]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '50g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[2]['name'] = '100g';
        $goldenBars[2]['description'] = '100 grama';
        $goldenBars[2]['slug'] = 'zlatne-poluge-100g';
        $goldenBars[2]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '100g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[3]['name'] = '250g';
        $goldenBars[3]['description'] = '250 grama';
        $goldenBars[3]['slug'] = 'zlatne-poluge-250g';
        $goldenBars[3]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '250g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[4]['name'] = '500g';
        $goldenBars[4]['description'] = '500 grama';
        $goldenBars[4]['slug'] = 'zlatne-poluge-500g';
        $goldenBars[4]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '500g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[5]['name'] = '1000g';
        $goldenBars[5]['description'] = '1000 grama';
        $goldenBars[5]['slug'] = 'zlatne-poluge-1000g';
        $goldenBars[5]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '1000g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        return view('frontend.themes.' . $this->theme . '.index', compact('posts', 'goldenPlates', 'goldenBars'));
    }

    public function cart()
    {
        return view('frontend.themes.' . $this->theme . '.cart');
    }

    public function checkout()
    {
        return view('frontend.themes.' . $this->theme . '.checkout.checkout');
    }

    public function checkoutSuccess()
    {
        return view('frontend.themes.' . $this->theme . '.checkout.success');
    }

    public function products()
    {
        //$actionProducts = Product::whereIn('id', $productsOnAction)->get();
        $products = Product::with(['files', 'categories'])->where('status', 'published')->where('price', '>', 0)->orderBy('price', 'asc')->paginate(48);
        $productMetas = getOption('product_metas_opt', []);
        $products = $this->updateProductsWithAction($products);
        $categories = ProductCategory::whereNull('parent_id')->get();
        return view('frontend.themes.' . $this->theme . '.products', compact('products', 'productMetas', 'categories'));
    }

    public function categoryProducts($categorySlug)
    {
        $selectedCategory = ProductCategory::where('slug', $categorySlug)->first();
        if ($selectedCategory) {
            $products = Product::with(['categories'])->where('status', 'published')->whereHas('categories', function ($query) use ($categorySlug) {
                $query->where(['slug' => $categorySlug]);
            })->where('price', '>', 0)->orderBy('price', 'asc')->paginate(48);
            $products = $this->updateProductsWithAction($products);
            $productMetas = getOption('product_metas_opt', []);
            $categories = ProductCategory::whereNull('parent_id')->get();
            return view('frontend.themes.' . $this->theme . '.products', compact('products', 'productMetas', 'selectedCategory', 'categories'));
        } else {
            return $this->product($categorySlug);
        }
    }

    public function actionProducts($actionSlug)
    {
        $action = ProductAction::first();
        $productsOnAction = json_decode($action['products']);
        $products = Product::whereIn('id', $productsOnAction)->get();
        $products = $this->updateProductsWithAction($products);
        $productMetas = getOption('product_metas_opt', []);
        return view('frontend.themes.' . $this->theme . '.products', compact('products', 'productMetas', 'action'));
    }

    public function product($slug)
    {
        $bestSellerProducts = Product::where('featured', 'best-seller')->where('status', 'published')->get();
        $bestSellerProducts = $this->updateProductsWithAction($bestSellerProducts);
        $product = Product::where('slug', $slug)->first();
        if (isset($product->landing) && $product->landing !== '') {
            $landing = json_decode($product->landing);
        } else {
            $landing = [];
        }
        $productMetas = getOption('product_metas_opt', []);
        $product = $this->updateProductWithAction($product);
        return view('frontend.themes.' . $this->theme . '.product', compact('product', 'productMetas', 'landing', 'bestSellerProducts'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('frontend.themes.' . $this->theme . '.page', compact('page'));
    }

    public function posts()
    {
        $posts = Post::with(['categories'])->where('status', 'published')->paginate(10);
        return view('frontend.themes.' . $this->theme . '.posts', compact('posts'));
    }

    public function categoryPosts($categorySlug)
    {
        $selectedCategory = PostCategory::where('slug', $categorySlug)->first();
        if ($selectedCategory) {
            $posts = Post::with(['categories'])->whereHas('categories', function ($query) use ($categorySlug) {
                $query->where(['slug' => $categorySlug]);
            })->paginate(10);
            return view('frontend.themes.' . $this->theme . '.posts', compact('posts', 'selectedCategory'));
        } else {
            return $this->post($categorySlug);
        }
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $categories = PostCategory::all();
        return view('frontend.themes.' . $this->theme . '.post', compact('post', 'categories'));
    }

    public function services()
    {
        return view('frontend.themes.' . $this->theme . '.services');
    }

    public function contact()
    {
        return view('frontend.themes.' . $this->theme . '.contact');
    }

    public function stores()
    {
        return view('frontend.themes.' . $this->theme . '.stores');
    }

    public function about()
    {
        return view('frontend.themes.' . $this->theme . '.about');
    }

    public function smartDoor()
    {
        return view('frontend.themes.' . $this->theme . '.smartDoor');
    }


    public function updateProductsWithAction($products)
    {
        // Handle Valid Action
        $action = ProductAction::first(['name', 'products', 'discount', 'ends_at', 'description']);
        if ($action) {
            $productsOnAction = json_decode($action['products']);
            $discount = $action['discount'];
            foreach ($products as $product) {
                if (in_array($product->id, $productsOnAction)) {
                    $product->price_old = $product->price;
                    $product->price = $product->price * ((100 - $discount) / 100);
                    $product->action = $action->name;
                    $product->actionDate = $action->ends_at;
                    $product->actionDescription = $action->description;
                }
            }
        }
        return $products;
    }

    public function updateProductWithAction($product)
    {
        // Handle Valid Action
        $action = ProductAction::first(['name', 'products', 'discount', 'ends_at', 'description']);
        if ($action) {
            $productsOnAction = json_decode($action['products']);
            $discount = $action['discount'];
            if (in_array($product->id, $productsOnAction)) {
                $product->price_old = $product->price;
                $product->price = $product->price * ((100 - $discount) / 100);
                $product->action = $action->name;
                $product->actionDate = $action->ends_at;
                $product->actionDescription = $action->description;
            }
        }
        return $product;
    }

    public function search(Request $request)
    {
        $searchString = $request->searchString;
        $products = Product::with(['files', 'categories'])
            ->where('status', 'published')
            ->where('price', '>', 0)
            ->where('name', 'LIKE', '%' . $searchString . '%')
            ->orWhere('external_id', 'LIKE', '%' . $searchString . '%')
            ->orWhere('subtitle', 'LIKE', '%' . $searchString . '%')
            ->orderBy('price', 'asc')->paginate(48);
        return view('frontend.themes.' . $this->theme . '.search', compact('products', 'searchString'));
    }

    public function goldenPlates()
    {
        $goldenPlates[0]['name'] = '1g';
        $goldenPlates[0]['description'] = '1 grama';
        $goldenPlates[0]['slug'] = 'zlatne-plocice-1g';
        $goldenPlates[0]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '1g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenPlates[1]['name'] = '2g';
        $goldenPlates[1]['description'] = '2 grama';
        $goldenPlates[1]['slug'] = 'zlatne-plocice-2g';
        $goldenPlates[1]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '2g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenPlates[2]['name'] = '5g';
        $goldenPlates[2]['description'] = '5 grama';
        $goldenPlates[2]['slug'] = 'zlatne-plocice-5g';
        $goldenPlates[2]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '5g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenPlates[3]['name'] = '10g';
        $goldenPlates[3]['description'] = '10 grama';
        $goldenPlates[3]['slug'] = 'zlatne-plocice-10g';
        $goldenPlates[3]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '10g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenPlates[4]['name'] = '20g';
        $goldenPlates[4]['description'] = '20 grama';
        $goldenPlates[4]['slug'] = 'zlatne-plocice-20g';
        $goldenPlates[4]['products'] = Product::with(['company'])->whereHas('categories', function ($q) {
            $q->where('name', '20g');
        })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        return view('frontend.themes.' . $this->theme . '.plates', compact('goldenPlates'));
    }

    public function goldenBars()
    {
        $goldenBars[0]['name'] = '1unca';
        $goldenBars[0]['description'] = '1 unca';
        $goldenBars[0]['slug'] = 'zlatne-poluge-1unca';
        $goldenBars[0]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '1unca');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[1]['name'] = '50g';
        $goldenBars[1]['description'] = '50 grama';
        $goldenBars[1]['slug'] = 'zlatne-poluge-50g';
        $goldenBars[1]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '50g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[2]['name'] = '100g';
        $goldenBars[2]['description'] = '100 grama';
        $goldenBars[2]['slug'] = 'zlatne-poluge-100g';
        $goldenBars[2]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '100g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[3]['name'] = '250g';
        $goldenBars[3]['description'] = '250 grama';
        $goldenBars[3]['slug'] = 'zlatne-poluge-250g';
        $goldenBars[3]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '250g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[4]['name'] = '500g';
        $goldenBars[4]['description'] = '500 grama';
        $goldenBars[4]['slug'] = 'zlatne-poluge-500g';
        $goldenBars[4]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '500g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        $goldenBars[5]['name'] = '1000g';
        $goldenBars[5]['description'] = '1000 grama';
        $goldenBars[5]['slug'] = 'zlatne-poluge-1000g';
        $goldenBars[5]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', '1000g');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get()->take(3);

        return view('frontend.themes.' . $this->theme . '.bars', compact('goldenBars'));
    }

    public function goldenCoins()
    {
        $category = ProductCategory::where('slug', 'dukati')->first();
        $goldenCoins[0]['name'] = 'Dukati';
        $goldenCoins[0]['description'] = 'Dukati';
        $goldenCoins[0]['slug'] = 'zlatni-dukati';
        $goldenCoins[0]['products'] = Product::with(['company'])->whereNotNull('selling_price')
            ->where('selling_price', '>', 0)->whereHas('categories', function ($q) {
                $q->where('name', 'Dukati');
            })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get();


        return view('frontend.themes.' . $this->theme . '.coins', compact('goldenCoins', 'category'));
    }

    public function category($categorySlug)
    {
        $category = ProductCategory::where('slug', $categorySlug)->first();
        $products = Product::whereHas('categories', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        })->orderBy('quantity_type', 'desc')->orderBy('selling_price', 'asc')->get();
        return view('frontend.themes.' . $this->theme . '.category', compact('products', 'category'));
    }

    public function companies()
    {
        return view('frontend.themes.' . $this->theme . '.companies');
    }

    public function price()
    {
        return view('frontend.themes.' . $this->theme . '.price');
    }

    public function exchange()
    {
        return view('frontend.themes.' . $this->theme . '.exchange');
    }
}
