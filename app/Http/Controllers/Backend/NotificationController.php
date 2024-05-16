<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\PriceChangeEmail;
use App\Models\PricePercentChange;
use App\Notifications\PricePercentChangeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{

    /**
     * Send Notification For Price Percentage Change
     * When price for product is changed by the value (%) that is set in product category,
     * notification will bi triggered for al those catched in time period
     */
    public function sendNotificationForPricePercentageChanges()
    {
        $priceChanges = PricePercentChange::where('notified', 0)->get();
        if (count($priceChanges) > 0) {
            /* Notification::route('mail', ['office@zlatnistandard.rs', 'zlatnistd@gmail.com'])
                ->notify(new PricePercentChangeNotification($priceChanges)); */
            Mail::to(['office@zlatnistandard.rs', 'zlatnistd@gmail.com', 'srdjank90@gmail.com'])->send(new PriceChangeEmail($priceChanges));
        }
    }

    /**
     * 
     */
    public static function storePricePercentChange($oldPrice, $newPrice, $product, $checkedAt)
    {
        // Catch percentage change for first category
        $divider = NotificationController::getPriceDivider($product);

        if ($divider != 0 && $divider != null) {
            $oldPricePerGram = $oldPrice / $divider;
            $newPricePerGram = $newPrice / $divider;
        } else {
            $oldPricePerGram = $oldPrice;
            $newPricePerGram = $newPrice;
        }

        $percentageTrigger = $product->categories[0]->notification_percent;
        // If prices different than percentage set then store that change
        if ($oldPricePerGram != 0 && $newPricePerGram != 0 && $percentageTrigger > 0) {
            $percentChange = (($newPricePerGram - $oldPricePerGram) / $oldPricePerGram) * 100;
            $percentChange = number_format($percentChange, 2, '.');
            if (abs(floatval($percentChange)) >= $percentageTrigger) {
                $pricePercentChangeData = [
                    'product_id' => $product->id,
                    'percentage_set' => $percentageTrigger,
                    'percentage_change' => $percentChange,
                    'old_price' => $oldPrice,
                    'new_price' => $newPrice,
                    'checked_at' => $checkedAt
                ];
                $pricePercentChangeItem = new PricePercentChange();
                $pricePercentChangeItem->create($pricePercentChangeData);
            }
        }
    }

    public static function getPriceDivider($product)
    {
        if (str_contains($product->name, '1000g') !== false) {
            return 1000;
        }

        if (str_contains($product->name, '500g') !== false) {
            return 500;
        }

        if (str_contains($product->name, '250g') !== false) {
            return $product->selling_price / 250;
        }

        if (str_contains($product->name, '100g') !== false) {
            return $product->selling_price / 100;
        }

        if (str_contains($product->name, '50g') !== false) {
            return $product->selling_price / 50;
        }

        if (str_contains($product->name, '1oz') !== false) {
            return $product->selling_price / 31;
        }

        if (str_contains($product->name, '20g') !== false) {
            return $product->selling_price / 20;
        }

        if (str_contains($product->name, '10g') !== false) {
            return $product->selling_price / 10;
        }

        if (str_contains($product->name, '5g') !== false) {
            return $product->selling_price / 5;
        }

        if (str_contains($product->name, '2g') !== false) {
            return $product->selling_price / 2;
        }

        if (str_contains($product->name, '1g') !== false) {
            return $product->selling_price / 1;
        }

        return 1;
    }
}
