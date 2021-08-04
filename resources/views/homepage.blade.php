@extends('layouts.app')

@section('content')
<div class="wrap-home">
    @include('components.advertisement')

    <div class="sale">
        <div class="sale-item">
            <img src="{{ asset('images/sale.jpg') }}" alt="">
        </div>
    </div>

    @include('components.product', ['products', $products])
</div>

@endsection
