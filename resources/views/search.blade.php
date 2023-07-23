@extends('layouts.app')
@section('content')
    

<div class="content">
    <div class="content_product">   
            <h2>Возможно вы искали:</h2>
        <div class="content_wrap">
            @foreach($searchProduct as $product)
            <div class="product_block">
                <div class="product_img">
                    <a href="{{route('desc_product', $product->id)}}">
                        <img src="{{$product->img}}" alt="">
                    </a>
                </div>
                <div class="product_title">
                    {{$product->name}}
                </div>
                <div class="product_prise">
                    {{$product->amount}}
                </div>
                <div class="add_cart">
                    <a href="{{route('cart_user_add', $product->id)}}"
                        style="color:#000;
                        text-decoration:none;
                        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                        Добавит в корзину
                        <i class="fa-solid fa-cart-shopping" style="color:blueviolet"></i>
                    </a>
            </div>
        </div>
            @endforeach
    </div>

</div>



            @endsection