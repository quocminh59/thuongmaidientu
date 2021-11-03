@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css\style\cart.css') }}">
@section('content')

<div class="breadcumb" v-if="type === 'cart'">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">Giỏ hàng của bạn</li>
        </ol>
    </nav>
</div>

@if (Session::has('Cart'))
    @php
        $cart = Session::get('Cart');
        $dt = [
            'products' => $cart->products,
            'totalPrice' => $cart->totalPrice,
            'totalQuantity' => $cart->totalQuantity,
            'status' => $cart->status,
            'token' => $cart->token
        ];
        $Data = json_encode($dt, true);
    @endphp
    <h1 v-if="type === 'cart'"><strong>Giỏ hàng</strong></h1>
    <cart :data = "{{ $Data }}" ref="cart"></cart>
@else
    <h1>Giỏ hàng trống</h1>
@endif

@endsection
