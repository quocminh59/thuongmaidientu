@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css\style\cart.css') }}">
@section('content')

<div class="breadcumb">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">Giỏ hàng của bạn</li>
        </ol>
    </nav>
</div>

@if (Session::has('Cart'))
    <div class="thaotac">
        <a href="{{ route('home') }}" class="btn btn-secondary">CHỌN TIẾP SẢN PHẨM KHÁC</a>
        <a href="{{ route('home') }}" class="btn btn-danger">Xóa giỏ hàng</a>
    </div>

    <div class="wrap-main">
        @php
            $list = Session::get('Cart');
            $totalQuantity = 0;
        @endphp
        @foreach ($list->products as $item)
            <div class="wrap-product-item">
                <a href="">
                    <img src="{{ asset($item['productInfo']->feature_image) }}" alt="">
                </a>
                <div class="wrap-product-ttin">
                    <a href="">
                        {{ $item['productInfo']->name }}
                    </a>
                    <span>
                        <strong>Bảo hành:</strong>
                        12 tháng
                    </span>
                </div>
                <div class="wrap-product-ttac">
                    <span>19.199.000 đ</span>
                    <div class="number-input">
                        <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                        <input class="quantity" min="0" name="quantity" value="{{ $item['quantity'] }}" type="number">
                        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                    </div>
                    <a href="">
                        <i class="fal fa-trash-alt"></i>
                    </a>
                </div>
            </div>
        @endforeach 

        <div class="total-money">
            Tổng tiền đơn hàng:
            <span>{{ number_format($list->totalPrice, 0, ',', '.') }} đ</span>
        </div>
    @else
        <h1>Giỏ hàng trống</h1>
    @endif
</div>

@endsection
