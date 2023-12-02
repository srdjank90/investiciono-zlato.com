<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Notifications\CheckoutNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class CheckoutController extends Controller
{
    public function createOrder(Request $request)
    {
        $orderProducts = json_decode($request->products);
        $order = new Order();

        $checkoutHtml = $request->checkoutHtml;

        $orderData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'company' => $request->company,
            'company_address' => $request->company_address,
            'pib' => $request->pib,
            'note' => $request->note,
            'country' => 'Srbija',
            'city' => $request->city,
            'zip' => $request->zip,
            'shipping_service' => 'BEX kurirska služba',
            'status' => 'pending',
            'total' => $request->total,
            'subtotal' => $request->subtotal
        ];

        $id = $order->create($orderData)->id;

        /* $customer = Customer::where('email', $request->email)->first();
        
        if (!$customer) {
            $newCustomer = new Customer();
            $customerData = [
                'name' => $request->first_name . " " . $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'zip' => $request->zip,
            ];
            $customerId = $newCustomer->create($customerData)->id;
        } */

        // Create OID
        $oid = sprintf("%08d", $id);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('dmy');
        $oid = "RM-" . $formattedDate . $id;

        $order = Order::find($id);

        $subtotalPrice = 0;
        $totalPrice = 0;
        $shippingPrice = 400;
        // Order products
        foreach ($orderProducts as $product) {
            $quantity = $product->quantity;
            $subtotalPrice = $subtotalPrice + $product->price * $quantity;
            $orderProduct = new OrderProduct();
            $prodData = Product::find($product->id);
            //$prodData->stock = $prodData->stock - $quantity;
            $prodData->save();
            $orderProductData = [
                'order_id' => $id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'meta_data' => json_encode($product->meta),
                'single_price' => $product->price,
                'total_price' => $quantity * $product->price,
            ];
            $pid = $orderProduct->create($orderProductData)->id;
        }

        $totalPrice = $subtotalPrice + $shippingPrice;
        $order->update(['oid' => $oid/* , 'subtotal' => $subtotalPrice, 'total' => $totalPrice, 'shipping_price' => $shippingPrice */]);
        /* try{
            Mail::to($order->email)->send(new OrderMail($order));
            $order->update(['invoice_sent' => 1]);
            Mail::to('info@minute.shop')->send(new OrderMail($order));
        }catch(\Exception $e){
            Log::error($e->getMessage());
        } */

        Notification::route('mail', $request->email)
            ->notify(new CheckoutNotification($order));
        Notification::route('mail', 'info@studiozadizajn.rs')
            ->notify(new CheckoutNotification($order));

        $order = '';
        return redirect()->route('frontend.checkout.success', compact('order'));
    }
}
