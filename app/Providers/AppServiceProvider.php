<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Post;
use App\Models\ProductAction;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function () {
            return base_path() . '/public_html';
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        if (!$this->app->runningInConsole()) {
            $currency = getOption('product_currency_opt', 'EUR');
            $productMetas = getOption('product_metas_opt', []);
            $productCategories = ProductCategory::where('slug', '!=', 'uncategorized')->orderBy('order', 'asc')->orderBy('created_at', 'asc')->get();
            $parentProductCategories = ProductCategory::whereNull('parent_id')->get();
            $settings = getOptions('setting');
            $productAction = ProductAction::orderBy('id', 'desc')->first();
            $posts = Post::orderBy('created_at', 'desc')->get();
            $companies = Company::all();

            $najboljiSaveti = Post::whereHas('categories', function ($q) {
                $q->where('id', 1);
            })->orderBy('created_at', 'desc')->get()->take(3);

            $najnovijiTekstovi = Post::whereHas('categories', function ($q) {
                $q->where('id', 2);
            })->orderBy('created_at', 'desc')->get()->take(3);

            View::share('najboljiSaveti', $najboljiSaveti);
            View::share('najnovijiTekstovi', $najnovijiTekstovi);
            View::share('companies', $companies);
            View::share('storageUrl', '/storage/');
            View::share('currency', $currency);
            View::share('productMetas', $productMetas);
            View::share('setting', $settings);
            View::share('productAction', $productAction);
            View::share('productCategories', $productCategories);
            View::share('parentProductCategories', $parentProductCategories);
            View::share('posts', $posts);
        }

        // Blade directives
        Blade::directive('priceFormat', function ($money) {
            return "<?php echo number_format($money, 2,',','.'); ?>";
        });

        // Parse Date
        Blade::directive('dateFormat', function ($date) {
            $date = Carbon::parse($date);
            return $date->format('dd/mm/yyyy');
        });
    }
}
