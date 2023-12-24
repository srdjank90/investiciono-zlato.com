<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use ZipArchive;

class FileController extends Controller
{
    public function downloadPricesExport($file)
    {
        $filePath = Storage::disk('public')->url('exports/prices/' . $file);
        return redirect($filePath);
    }

    public function downloadProductPricesExport($file, $id)
    {
        $product = Product::find($id);
        $filePath = Storage::disk('public')->url('exports/products/' . $product->slug . '/' . $product->slug . '_' . $file . '.xlsx');
        return redirect($filePath);
    }


    public function downloadZipProductPrices()
    {
        // Path to the directory containing folders to be zipped
        $directoryPath = public_path() . '\storage\exports\products'; // Change this to your actual path
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
