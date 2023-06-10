<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function show($paymentgateway)
    {
     
        if(!session()->has('orderId'))
        {
            return redirect('home');
        }
        $order=Order::where('tracking_id', session('orderId'))->first();
        
         if($paymentgateway=='cod')
      {
          return view('Payments.cod');
      }
      if($paymentgateway=='khalti')
      {
        $parameters=[
            'return_url'=>route('thankyou'),
            'website_url'=>config('app.url'),
            'amount'=> $order->total,
            'purchase_order_id'=>$order->tracking_id,
            'purchase_order_name' => 'NEPLANT'.$order->tracking_id,
        ];
        
        
       $response=  Http::withHeaders([
            'Authorization'=>'Key ' . config('khalti.live_secret_key') ,

        ])-> post(config("khalti.base_url") .'/epayment/initiate/',$parameters);
     //  dd($response->body());
        if($response->failed())
        {
            return view('failed');
        }
        $data=$response->json();
        return redirect($data['payment_url']);         

      }
    }
    public function thankyou(Request $request )
    {
        $data=$request->all();
      $order= Order::where('tracking_id',$data['purchase_order_id'])->firstorFail();
      
    //verification
     $verify= Http::withHeaders([
        'Authorization'=>'Key ' . config('khalti.live_secret_key') ,
    ])-> post(config("khalti.base_url") .'/epayment/lookup/',[
        'pidx'=>$data['pidx'],
        
    ]);
    $dataverified=$verify->json();
    if($verify->failed())
    {
        return view('failed');
    }
       $orderPayment= $order->payment->update([
            'payment_status'=>'PAID',
            'price_paid'=>$dataverified['total_amount'],
            'transaction_id'=>$data['transaction_id']
        ]);
        return view('thankyou');
        
    }
}
