@extends('layouts.app')

@section('head')
@endsection

@section('header')
@endsection

@section('content')
    <div class="container container--login">
        <form class="login-form @if($errors->any()) login-form--invalid @endif" action="{{ route('login.auth') }}" method="POST">
            @csrf
            <div class="login-form__row @error('login') login-form--invalid @enderror">
                <label for="login" class="login-form__label">Логин:</label>
                <input class="ui-input login-form__input" type="text" name="login" id="login" placeholder=""  value="{{ old('login') ?? session('login') }}">
            </div>
            <div class="login-form__row @error('pass') login-form--invalid @enderror">
                <label for="pass" class="login-form__label">Пароль:</label>
                <input class="ui-input login-form__input" type="text" name="pass" id="pass" placeholder="" value="{{ old('pass') ?? session('pass') }}">
            </div>
            <div class="login-form__row">
                <div class="buttons">
                    <button class="button button--success">Авторизоваться</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')
@endsection
