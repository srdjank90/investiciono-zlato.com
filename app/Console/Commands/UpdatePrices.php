<?php

namespace App\Console\Commands;

use App\Http\Controllers\Backend\PriceUpdateController;
use Illuminate\Console\Command;

class UpdatePrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-prices';

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
        $uc = new PriceUpdateController();
        $uc->updatePrices();
    }
}
