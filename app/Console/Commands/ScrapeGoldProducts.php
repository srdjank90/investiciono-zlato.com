<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Weidner\Goutte\GoutteFacade;

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
        $this->test('https://www.gvs-srbija.rs/kupi/zlatnici.html');
    }

    public function test($url)
    {
        #$url = 'https://www.google.com/search?q=Town+of+Aurora,WI,Florence+county';
        #$url = 'https://www.google.com/search?q=Reine+Township,MN,Roseau+county';

        $matches = [];
        try {
            $crawler = GoutteFacade::request('GET', $url);
            $matches[] = $crawler->filter('.product-item-link.productListColumnProductTitle')->each(function ($node) {
                Log::info($node->text());
                Log::info($node->extract(array('href'))[0]);
                #return $node->extract(array('href'))[0];
            });
            Log::info($matches);
            return 1;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return 0;
        }
    }
}
