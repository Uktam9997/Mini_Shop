@extends('layouts.app')
@section('content')

<div class="content">
    <div class="product_block">
        <div class="product_img">
            <a href="{{route('cart_shop')}}">
                <img src="{{$product->img}}" alt="">
            </a>
        </div>
        <div class="product_title">
            {{$product->name}}
        </div>
        <div class="product_prise">
            {{$product->amount}}
        </div>
        <div class="product_prise">
            {{$product->desc}}
        </div>
        <div class="product_prise">
            {{$product->quantity}}
        </div>
    </div>
</div>

@endsection