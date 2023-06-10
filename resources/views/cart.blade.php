@extends('layout')

@section('content')
 <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($items as $hash=>$item)
                                <td class="shoping__cart__item">
                                        <img src="img/cart/cart-1.jpg" alt="">
                                    <h5>{{$item->getDetails()->title}} </h5>
                                </td>
                               
                                <td class="shoping__cart__price">
                                   {{$item->getDetails()->price}}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                         <form action="/cart/update" method="post" id="updateForm-{{$hash}}" >
                                                @csrf
                                                @method('POST')
                                                <div class="pro-qty">
                                           
                                                <input type="hidden" name="hash" value="{{$hash}}">                            
                                                 <input type="text" value="{{$item->getQuantity()}} " onformchange ="updateCart('{{$hash}}')" name="quantity"/>
                                           
                                        </div>
                                     </form>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    {{($item->getDetails()->total_price)}}
                                </td>
                                <td class="shoping__cart__item__close" onclick="deleteCart('{{$hash}}' )">
                                
                                    <span class="icon_close"></span>
                                    <form action="cart/remove" method="post" id="deleteForm-{{$hash}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name='itemHash' value='{{$hash}}' >
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <button type='submit' class="primary-btn cart-btn cart-btn-right" name="update" ><span class="icon_loading"></span>
                        Upadate Cart</a>
                    
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span>{{$subtotal}}</span></li>
                        <li>Total <span>{{$total}}</span></li>
                    </ul>
                    
                    <a href="/checkout" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->
@endsection
@section('scripts')
    <script>
       function deleteCart(hash)
       {
    console.log(hash);
        let userConfirmation=confirm("Are you sure you want to delete this item?");
        if(!userConfirmation)
        {return;}
        let form=$('#deleteForm-'+hash);
        console.log('#deleteForm-'+hash);
        form.submit();
    }
    function updateCart(hash,quantity)
    {
        let form=$('#updateForm-'+hash);
        console.log(hash);
        console.log(quantity);
        console.log('#updateForm-'+hash);
        
         form.submit();
    }
    </script>
@endsection