@extends('layouts.app')
@section('content')

@if (count($errors) > 0)
    <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif

    <form action="{{route('registr_user')}}" class="form_registr" method="post">
        @csrf
        <input type="text" name="name" placeholder="Имя"><br>
        <input type="email" name="email" placeholder="Емаил"><br>
        <input type="password" name="password" placeholder="Парол"><br>
        <button type="submit">Зарегистрироватся</button><br>
        Если вы уже зарегистрированни - <a href="{{route('auth_user')}}">
            Вход
        </a>
    </form>

    @endsection
