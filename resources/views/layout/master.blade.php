<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/assets/js/jquery-2.2.4.min.js" defer></script>
    <script src="/assets/js/bootstrap.min.js" defer></script>
    <script src="/assets/js/js.cookie.js" defer></script>
    <script src="/assets/js/shop-laravel.js" defer></script>
    
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">

    <title> @yield('title') - My Shop Laravel</title>
</head>

<body>
    <header>
        
        <ul class="nav">
            <li><a href="/">{{ trans('shop.home') }}</a></li>

            <li>
              <a href="#">
                <span class="set_language" data-language="zh-TW">
                  中文
                </span>
                /
                <span class="set_language" data-language="en">
                  English
                </span>              
              </a>
            </li>
            
          @if(session()->has('user_id'))
            <li><a href="/transaction">{{ trans('shop.transaction.name') }}</a></li>
            <li><a href="/merchandise/create">{{ trans('shop.merchandise.create') }}</a></li>
            <li><a href="/merchandise/manage">{{ trans('shop.merchandise.manage') }}</a></li>

            <li><a href="/user/auth/sign-out">{{ trans('shop.auth.sign-out') }}</a></li>
          @else
            <li><a href="/user/auth/sign-in">{{ trans('shop.auth.sign-in') }}</a></li>
            <li><a href="/user/auth/sign-up">{{ trans('shop.auth.sign-up') }}</a></li>
					@endif
        </ul>
    </header>


    <div class="container">
        @yield('content')
    </div>

    <footer>
        <a href="#">Contact Us</a>
    </footer>


</body>

</html>
