<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PricePercentChange;
use App\Notifications\PricePercentChangeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        Log::info('Percentage notification triggered!');
        $priceChanges = PricePercentChange::where('notified', 0)->get();
        if (count($priceChanges) > 0) {
            Notification::route('mail', ['office@zlatnistandard.rs', 'zlatnistd@gmail.com'])
                ->notify(new PricePercentChangeNotification($priceChanges));
        }
    }

    /**
     * 
     */
    public static function storePricePercentChange($oldPrice, $newPrice, $product, $checkedAt)
    {
        $percentageTrigger = $product->categories[0]->notification_percent;
        // If prices different than percentage set then store that change
        if ($oldPrice != 0 && $newPrice != 0 && $percentageTrigger > 0) {
            $percentChange = (($newPrice - $oldPrice) / $oldPrice) * 100;
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
}
