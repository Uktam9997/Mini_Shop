<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <div class="header_container">
            <div class="header_top">
                <div class="header_logo">
                    <p>Woo Widget</p>
                </div>
                <div class="header_search">
                    <form action="{{route('search_product')}}" method="post">
                        @csrf
                        <input type="text" name="search" class="search" placeholder="Search for product">
                        <button type="submit">Search</button>
                    </form>
                    @if (count($errors) > 0)
                        <ul>
                        @foreach ($errors->all() as $error)
                        <li style="color:aliceblue;">{{ $error }}</li>
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="header_botton">
                <div class="header_nav">
                    <a href="{{route('home')}}">Главная</a>
                    <a href="#">Доставка</a>
                    <a href="#">Контакты</a>
                    <a href="#">Оплата</a>
                </div>
                @if(Auth::user())
                    <div class="auth_user_name">
                        <p class="user_name">
                        {{ Auth::user()->name }}
                        </p>
                    </div>
                    <a href="{{route('logout_user')}}" style="color:crimson">Выход</a>
                @endif
                <div class="header_cart">
                   <a href="{{route('cart_shop')}}"><i class="fa-solid fa-cart-shopping"></i></a><br>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
</body>
</html>