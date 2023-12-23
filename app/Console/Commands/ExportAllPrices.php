<?php

namespace App\Console\Commands;

use App\Http\Controllers\Backend\PriceController;
use Illuminate\Console\Command;

class ExportAllPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:prices';

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
        $priceController = new PriceController();
        $priceController->exportAllPricesCron();
    }
}
