<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pinterayst</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/start.css')}}">
    <link rel="stylesheet" href="{{ asset('css/pins.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <script src="{{ asset('js/nav.js') }}" defer></script>
    <script src="{{ asset('js/create.js') }}" defer></script>
    <script src="{{ asset('js/start.js') }}" defer></script>
</head>
    <body>
        <nav class="navbar">
            <img src="{{ asset('images/logo.png') }}" alt="" class="homeLogo">
            <div class="anchors">
                <a href="{{ route('admin_home') }}">Pins</a>
                <a href="{{ route('admin_users') }}">Users</a>
            </div>
            {{-- <a href=""></a> --}}
            <form action="{{ route('search_admin') }}" method="POST" style="align-items: center; display: flex">
                @csrf
                <input type="text" name="searched" placeholder="Search" id="searchField">
                <img src="{{ asset('images/searchIcon.jpg') }}" id="searchBtn" alt="">
                <button type="submit" style="display: none" id="submitBtn">search</button>
            </form>
            <a href="{{ route('admin_profile') }}" style="margin-left: auto;">
                <img src="{{ Storage::url(Auth::user()->user_url) }}" alt="" class="homeProfile">
            </a>
        </nav>
        @yield('content')
    </body>
</html>
