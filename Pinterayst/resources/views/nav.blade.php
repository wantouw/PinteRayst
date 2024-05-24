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
                <a href="{{ route('home_page', ['user_id'=>Auth::id()]) }}">Home</a>
                {{-- <a href="">Explore</a> --}}
                <a href="{{ route('create_page', ['user_id'=>Auth::id()]) }}">Create</a>
            </div>
            {{-- <a href=""></a> --}}
            <form action="{{ route('search') }}" method="GET" style="align-items: center; display: flex">
                @csrf

                <input type="text" name="searched" placeholder="Search" value="{{$search ?? ""}}" id="searchField">
                <img src="{{ asset('images/searchIcon.jpg') }}" id="searchBtn" alt="">
                <button type="submit" style="display: none" id="submitBtn">search</button>
            </form>
            <a href="{{ route('profile_created', ['user_id'=>Auth::id()]) }}" style="margin-left: auto;">
                <img src="{{ Storage::url(Auth::user()->user_url) }}" alt="" class="homeProfile">
            </a>
        </nav>
        @yield('content')
    </body>
</html>
