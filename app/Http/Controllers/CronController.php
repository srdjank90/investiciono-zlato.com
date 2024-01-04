<?php

namespace App\Http\Controllers;

use App\Exports\PricesAllExport;
use App\Exports\PricesExport;
use App\Http\Controllers\Backend\PriceController;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class CronController extends Controller
{
    /**
     * Cron Day
     */
    public function cronDay()
    {
        // First export all prices
        $this->exportAllPricesInOneExcelFile();

        // Second make all prices separated files in folders
        $this->exportProductPricesSeparated();

        // Create zip file of all separeted product prices export
        $this->createProductPricesZip();

        // Empty Prices Table in DB
        DB::table('prices')->truncate();
    }

    /**
     * Export All Prices in One Excel File
     * Function creates daily .xlsx file for all product prices
     */
    public function exportAllPricesInOneExcelFile()
    {
        $filename = '';
        $dateTime = Carbon::now()->format('d_m_Y_H_i');
        $filename = 'prices_all_' . $dateTime . '.xlsx';
        $path = 'exports/prices/' . $filename;
        Excel::store(new PricesAllExport(), $path, 'public');
    }

    /**
     * Export Product Prices Separated
     * Function export product prices separated in folders and for each day - recording date and time
     */
    public function exportProductPricesSeparated()
    {
        $filename = '';
        $dateTime = Carbon::now()->format('d_m_Y_H_i');
        $products = Product::all();
        foreach ($products as $product) {
            $filename = $product->slug . '_' . $dateTime . '.xlsx';
            $path = 'exports/products/' . $product->slug . '/' . $filename;
            Excel::store(new PricesExport($product->id), $path, 'public');
        }
    }

    /**
     * Create Product Prices Zip
     * Function creates zip of all separated product prices xlsx files
     */
    public function createProductPricesZip()
    {
        // Path to the directory containing folders to be zipped
        $directoryPath = public_path() . '/storage/exports/products'; // Change this to your actual path
        #$directoryPath = 'C:\wamp64\www\zlatoteka.rs\public_html\storage\exports\products'; // Change this to your actual path

        // Create a unique filename for the zip file
        $zipFileName = 'product-prices.zip';

        // Create a ZipArchive instance
        $zip = new ZipArchive;

        // Open the zip file for writing
        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            // Get all subdirectories in the specified directory
            $directories = File::directories($directoryPath);
            $d = Carbon::now()->format('d_m_Y');
            foreach ($directories as $directory) {
                // Add each directory and its contents to the zip file
                $zip->addEmptyDir(basename($directory));

                $files = File::allFiles($directory);

                foreach ($files as $file) {
                    if (str_contains($file, $d)) {
                        $zip->addFile($file->getRealPath(), basename($directory) . '/' . $file->getFilename());
                    }
                }
            }

            // Close the zip file
            $zip->close();

            // Download the zip file
            return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
        }

        return response()->json(['error' => 'Failed to create zip file.']);
    }
}
