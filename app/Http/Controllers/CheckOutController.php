<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;
use App\Models\Address;

class CheckOutController extends Controller
{
    public function checkout(){
        $items=Cart::name('shopping')->getItems();
       // dd($items);
         $total=Cart::name('shopping')->getTotal();
         $subtotal=Cart::name('shopping')->getSubtotal(); 
      // dd($items);
        return view('checkout',[

            'items'=>$items,
            'total'=>$total,
            'subtotal'=>$subtotal
        ]);
        
    }
    public function store(Request $request){
        $items=Cart::name('shopping')->getItems();
        // dd($items);
         $total=Cart::name('shopping')->getTotal();
         $shoppingCart=Cart::name('shopping');
        $data= $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'country'=>'required',
            'province'=>'required',
            'district'=>'required',
            'zip'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'payment_method'=>'required'
        ]);
        
        //Create Addresss
        $address= Address::create([
            'country'=>$data['country'],
            'province'=>$data['province'],
            'district'=>$data['district'],
            'zipcode'=>$data['zip'],
            'street_address'=>$data['address']
        ]);
        //Create Payment
        $paymentGateway=PaymentGateway::where('code',$data['payment_method'])->first();
        $payment=Payment::create([
            'payment_gateway_id'=>$paymentGateway->id,
            'payment_status'=>'NOT_PAID',
            'price_paid'=>0
        ]);
        //Create Order
        $order=Order::create([
            'tracking_id'=>"NEP-".uniqid(),
            'total'=>$total*100,
            'full_name'=>$data['firstname']." ".$data['lastname'],
            'email'=>$data['email'],
            'phone_number'=>$data['phone'],
            'billing_id'=>$address->id,
            'shipping_id'=>$address->id,
            'payment_id'=>$payment->id,
        ]);
        //Create Order Items
        foreach($items as $item){
            $OrderItems=OrderItem::Create([
                'order_id'=>$order->id,
                'product_id'=>$item->getId(),
                'name'=>$item->getTitle(),
                'quantity'=>$item->getQuantity(),
                'price'=>$item->getPrice()*100
            ]);
        }
        $shoppingCart->destroy();
       return redirect()->route('payment.show',['paymentgateway'=>$data['payment_method']])->with([
              'orderId'=>$order->tracking_id
       ]); 
    }
}
