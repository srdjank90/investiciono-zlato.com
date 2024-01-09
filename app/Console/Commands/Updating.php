<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        $this->updateNames();
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
            Log::info($product);
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
