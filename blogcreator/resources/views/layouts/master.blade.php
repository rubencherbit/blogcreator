<!DOCTYPE html>
<html>
<head>
    <title>my_blog_creator - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('style/style.css') }}">
</head>
<body>
    <div id="main-wrapper">
        @section('header')
            @include('layouts.header')
        @show

        <div class="main-container">
            @section('main-content')
            @if (count(session('infos')) > 0)
                <ul>
                    @foreach (session('infos') as $info)
                        <li>{{ $info }}</li>
                    @endforeach
                </ul>
            @endif
            @if (count(session('errors')) > 0)
                <ul>
                    @foreach (session('errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            @show
        </div>

    </div>
</body>
</html>