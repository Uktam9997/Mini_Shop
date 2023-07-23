@extends('layouts.app')
@section('content')

@if (count($errors) > 0)
    <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif
    <form action="{{route('user_auth')}}" class="form_auth" method="post">
        @csrf
        <input type="text" name="name" placeholder="Имя"><br>
        <input type="password" name="password" placeholder="Парол"><br>
        <button type="submit">Войти</button><br>
        Если вы не зарегистрированни - <a href="{{route('registr')}}">Зарегистрироватся</a>
    </form>



@endsection
