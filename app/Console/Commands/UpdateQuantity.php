<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductMeta;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateQuantity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quantity:update';

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
        $this->updateQuantity($token);
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
                if ($product->id !== 966) {
                    $product->quantity = $productQuantity;
                    $product->save();
                }
            } catch (\Exception $e) {
            }
        }
    }
}
