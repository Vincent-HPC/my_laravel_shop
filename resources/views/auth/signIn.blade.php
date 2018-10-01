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
            Email:
            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">

        </label>

        <label>
            密碼:
            <input type="password" name="password" placeholder="密碼" value="{{ old('password') }}">

        </label>

        <button type="submit">登入</button>

        <!-- For CSRF 欄位 -->
        {!! csrf_field() !!}
    </form>
</div>
@endsection
