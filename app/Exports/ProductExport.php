<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductExport implements FromQuery, WithMapping, WithHeadings, WithChunkReading
{
    use Exportable;
    protected $cat;
    public function __construct(String $cat)
    {
        $this->cat = $cat;
    }

    public function query()
    {
        if ($this->cat !== 'all') {
            return Product::query()->when($this->cat, function ($q) {
                $q->whereHas('categories', function ($qc) {
                    $qc->where('name', $this->cat);
                });
            });
        } else {
            return Product::query();
        }
    }

    public function headings(): array
    {
        // Define your headers
        return [
            'Key',
            'Naziv',
            'URL',
            'Prodajna cena',
            'Otkupna cena',
            'kompanija',
            'status'
            // Add more columns as needed
        ];
    }

    /**
     * @param Product $product
     */
    public function map($product): array
    {
        return [
            $product->unique_key,
            $product->name,
            $product->url,
            $product->selling_price,
            $product->purchase_price,
            $product->company,
            $product->status,
        ];
    }

    public function chunkSize(): int
    {
        return 1000; // Set your desired chunk size here
    }
}
