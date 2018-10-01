<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/assets/js/jquery-2.2.4.min.js" defer></script>
    <script src="/assets/js/bootstrap.min.js" defer></script>
    
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">

    <title> @yield('title') - My Shop Laravel</title>
</head>

<body>
    <header>
        
        <ul class="nav">
            <li><a href="/">My Shop Laravel</a></li>
          @if(session()->has('user_id'))
            <li><a href="/transaction">交易紀錄</a></li>
            <li><a href="/merchandise/create">商品新增</a></li>
            <li><a href="/merchandise/manage">商品管理清單</a></li>

            <li><a href="/user/auth/sign-out">登出</a></li>
          @else
            <li><a href="/user/auth/sign-in">登入</a></li>
            <li><a href="/user/auth/sign-up">註冊</a></li>
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
