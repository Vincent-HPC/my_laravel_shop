@extends('layout.master')

<!-- // $binding['title' => '註冊'] => signUp.blade_$title => layout.master @yield('title') -->
@section('title', $title)


@section('content')

<div class="container">
    <h1>{{ $title }}</h1>

    @include('components.socialButtons')
    @include('components.validationErrorMessage')

    <form action="/user/auth/sign-in" method="post">
        <label>
            {{ trans('shop.user.fields.email') }}:
            <input type="text" name="email" placeholder="{{ trans('shop.user.fields.email') }}" value="{{ old('email') }}">

        </label>

        <label>
            {{ trans('shop.user.fields.password') }}:
            <input type="password" name="password" placeholder="{{ trans('shop.user.fields.password') }}" value="{{ old('password') }}">

        </label>

        <button type="submit">{{ trans('shop.auth.sign-in') }}</button>

        <!-- For CSRF 欄位 -->
        {!! csrf_field() !!}
    </form>
</div>
@endsection
