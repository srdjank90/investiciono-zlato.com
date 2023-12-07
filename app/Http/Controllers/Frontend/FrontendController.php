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
    protected $theme = 'lika';

    public function __construct()
    {
        $this->theme = getOption('setting_theme_active_opt', 'lika');
    }

    public function index()
    {
        #$highlightedProducts = Product::where('highlighted', 1)->where('status', 'published')->get();
        #$highlightedProducts = $this->updateProductsWithAction($highlightedProducts);

        #$favoriteCategories = ProductCategory::where('favorite_flag', 1)->get();
        #$favoriteCategories = $this->updateProductsWithAction($favoriteCategories);

        #$bestSellerProducts = Product::where('featured', 'best-seller')->where('status', 'published')->get();
        #$bestSellerProducts = $this->updateProductsWithAction($bestSellerProducts);

        #$newProducts = Product::where('featured', 'new')->where('status', 'published')->get();
        #$newProducts = $this->updateProductsWithAction($newProducts);

        #$actionProducts = Product::where('featured', 'action')->where('status', 'published')->get();
        #$actionProducts = $this->updateProductsWithAction($actionProducts);

        #$productAction = ProductAction::orderBy('id', 'desc')->first();

        $posts = Post::orderBy('created_at', 'desc')->get()->take(3);

        return view('frontend.themes.' . $this->theme . '.index', compact('posts'));
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
}
