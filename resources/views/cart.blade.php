
@extends('layouts.app')
@section('content')
    
    <div class="content">
        <h2>Корзина</h2>
        @if($cartUser)
        @foreach($cartUser as $userProduct)
        <div class="product">
            <div class="product_title">
                {{$userProduct->product_name}}
            </div>
            <div class="product_quantity">
               кол-во тавара <input type="number" data-id="{{$userProduct->id}}" class="input_quantity" value="{{$userProduct->quantity}}">
            </div>
            <div class="product_prise">
            {{$userProduct->sum_product}}
            </div>
            <div class="delete_product">
                <form action="{{route('delete_cart_product', $userProduct->id)}}" method="post">
                    @csrf
                    <button type="submit" style="color:orangered;">Удалить</button>
                </form>
            </div>
        </div>
        @endforeach
        @endif
        <hr>
        <div class="product_sum">
            <div class="sum_text">
                Итого:
            </div>
            <div class="sum_amount">
               
            </div>
        </div>
    </div>

<script src="/assets/js/cart.js"></script>

    @endsection