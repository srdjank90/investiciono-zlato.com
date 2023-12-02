<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $websiteSitemap = Sitemap::create();

        Product::get()->each(function (Product $product) use ($websiteSitemap) {
            $websiteSitemap->add(
                Url::create("/proizvodi/{$product->slug}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        Post::get()->each(function (Post $post) use ($websiteSitemap) {
            $websiteSitemap->add(
                Url::create("/blog/{$post->slug}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        Page::get()->each(function (Page $page) use ($websiteSitemap) {
            $websiteSitemap->add(
                Url::create("/{$page->slug}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        $websiteSitemap->writeToFile(public_path('sitemap.xml'));
    }
}
