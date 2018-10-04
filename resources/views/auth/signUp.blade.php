

@extends('layout.master')

<!-- // $binding['title' => '註冊'] => signUp.blade_$title => layout.master @yield('title') -->
@section('title', $title)



@section('content')


	<h1> {{ $title }} </h1>

	@include('components.socialButtons')

  @include('components.validationErrorMessage')

	<form action="/user/auth/sign-up" method="post">

    <label>
      {{ trans('shop.user.fields.nickname') }}：
      <input type="text" name="nickname" placeholder="{{ trans('shop.user.fields.nickname') }}" 
      value="{{ old('nickname') }}"
      >
    
    </label>

    <label >
        {{ trans('shop.user.fields.email') }}：
        <input type="text" name="email" placeholder="{{ trans('shop.user.fields.email') }}"
        value="{{ old('email') }}"
        >

    </label>

    <label >
        {{ trans('shop.user.fields.password') }}:
        <input type="password" name="password" placeholder="{{ trans('shop.user.fields.password') }}">

    </label>  

    <label >
        {{ trans('shop.user.fields.confirm-password') }}:
        <input type="password" name="password_confirmation" placeholder="{{ trans('shop.user.fields.confirm-password') }}">
        
    </label>

    <label>
        {{ trans('shop.user.fields.type-name') }}
        <select name="type" >
            <option value="G"
                    @if(old('type')=='G') selected @endif
            >
                {{ trans('shop.user.fields.type.general') }}
            </option>
            <option value="A"
                    @if(old('type')=='A') selected @endif
            >
                {{ trans('shop.user.fields.type.admin') }}
            </option>
        </select>
    </label>      

    <button type="submit">{{ trans('shop.auth.sign-up') }}</button>

    <!-- For CSRF 欄位 -->
    {!! csrf_field() !!}
  </form>
@endsection
