<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class CartControler extends Controller
{
   public function add(Request $request)
   {
$product=Product::find($request->get('product_id'));
$qnty=(int)$request->post('quantity');
$shoppingCart   = Cart::name('shopping');
$shoppingCart->addItem([
    'id'       => $product->id,
    'title'     => $product->name,
    'quantity' =>$qnty,
    'price'    => $product->price,
]);

return back();
   }
   public function show(Request $request)
   {
    $items=Cart::name('shopping')->getItems();
   // dd($items);
    $total=Cart::name('shopping')->getTotal();
    $subtotal=Cart::name('shopping')->getSubtotal();
    return view('cart',[
        'items'=>$items,
        'total'=>$total,
        'subtotal'=>$subtotal
    ]);
    
   }
    public function delete(Request $request)
    {

$hash=$request->itemHash;
$shoppingCart=Cart::name('shopping');
$shoppingCart->removeItem($hash);
return back();
     
    }
    public function update(Request $request)
    {
        $hash=$request->hash;
        $qnty=$request->post('quantity');
//        dd($hash);
        $shoppingCart=Cart::name('shopping');
        $shoppingCart->updateItem($hash,[
            'quantity'=>$qnty
        ]);
        return back();
    }
}
