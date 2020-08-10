<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <script src="/js/jquery-3.4.1.js"></script>
        <!-- BootstrapのCSS読み込み -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <!-- jQuery読み込み -->
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
        <!-- BootstrapのJS読み込み -->
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/main.js"></script> 
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand navbar-light">
                <a href="" class="navbar-brand">BOOK MANAGE</a>
                <ul class="navbar-nav">
                    <li class="navbar-item">
                    <a class="nav-link" href="{{ url('/book/list') }}">一覧</a>
                    </li>
               
               
                    <li class="navbar-item">
                    <a class="nav-link" href="{{ url('/book/entry') }}">書籍登録</a>
                    </li>
               
                    @if(Auth::check())
                    <li>
                        <a class="nav-link" href="#" onclick="document.getElementById('ActionForm').submit();">ログアウト</a>
                        <form id="ActionForm" action="{{ url('/logout') }}" method="POST">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @else
                    <li>
                        <a class="nav-link" href="{{ url('/login') }}">ログイン</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ url('/book/list') }}">登録</a>
                    </li>
                    @endif               
                    {{-- <li class="navbar-item">
                    <a class="nav-link" href="{{ url('/') }}">HOME</a>
                    </li> --}}
                </ul>
            </nav>    
        </header>
        @yield('content')
        <script src=" {{ mix('/js/app.js') }} "></script>
    </body>
</html>
