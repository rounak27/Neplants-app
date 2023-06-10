@extends('layout');
@section('content')
    <!-- Checkout Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
           @if($errors->any())
           {
                <div class="alert alert-danger">
                     <ul>
                          @foreach($errors->all() as $error)
                          <li>{{$error}}</li>
                          @endforeach
                     </ul>
                </div>
           }
              @endif
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{route('checkout.store')}} " method="POST" >
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input @if($errors->has('firstname') )  invalid @endif">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="firstname">
                                        <small>{{$errors->first('firstname')}}</small>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input @if($errors->has('lastname') )  invalid @endif">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="lastname" value="{{old('lastname')}}" >
                                          <small>{{$errors->first('lastname')}}</small>

                                    </div>

                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country">
                            </div>
                            <div class="checkout__input @if($errors->has('address') )  invalid @endif">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="address" value="{{old('address')}}"> 
                                <small>{{$errors->first('address')}}</small>

                            </div>
                            <div class="checkout__input">
                                <p>District<span>*</span></p>
                                <input type="text" name="district">
                            </div>
                            <div class="checkout__input">
                                <p>Province<span>*</span></p>
                                <input type="text" name="province">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                    <input type="text"name='phone'>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text"name='email'>
                                    </div>
                                </div>
                            </div>
                           
                            
                        
                            
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach ($items as $item)
                                        
                                  
                                    <li>{{$item->getTitle()}} <span>{{$item->getPrice()}} </span></li>
                                      @endforeach
                              
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>{{$subtotal}} </span></div>
                                <div class="checkout__order__total">Total <span>{{$total}} </span></div>
                                
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Cash on delievery
                                        <input type="radio" id="payment" name="payment_method" value='cod' @if(old('payment_method')=='cod')checked @endif>
                                        <span class="checkmark"></span>

                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="khalti">
                                        Khalti
                                        <input type="radio" id="khalti" name="payment_method" value="khalti"@if(old('payment_method')=='khalti')checked @endif>
                                        <span class="checkmark"></span>
                                       

                                    </label>
                                     <small>{{$errors->first('payment_method')}}</small>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection