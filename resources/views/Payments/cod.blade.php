@extends('layout')
@section('content')
<div class="container">
    <div class="alert alert-success">
        The order has been placed successfully.Your order id is {{session('orderId')}}
    </div>
</div>
@endsection