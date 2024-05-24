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
                <a href="{{ route('guest_home') }}">Home</a>
            </div>
            {{-- <a href=""></a> --}}
            <form action="{{ route('search_guest') }}" method="POST" style="align-items: center; display: flex">
                @csrf
                <input type="text" name="searched" placeholder="Search" value="{{$search ?? ""}}" id="searchField">
                <img src="{{ asset('images/searchIcon.jpg') }}" id="searchBtn" alt="">
                <button type="submit" style="display: none" id="submitBtn">search</button>
            </form>
            <a href="{{ route('start') }}" style="margin-left: auto;">
                <img src="{{ asset('images/anime1.jpg') }}" alt="" class="homeProfile">
            </a>
        </nav>
        <div class="pinList">
            @foreach ($pins as $pin)
                <div class="pinContainer">
                    <a href="{{ route('pin_detail', ['pin_id'=>$pin->pin_id]) }}">
                        <img src="{{ Storage::url($pin->pin_url) }}" alt="asd" class="homePin">
                        <p class="homePinTitle">{{ $pin->pin_title }}</p>
                    </a>
                </div>
            @endforeach
        </div>
        {{$pins->Links('pagination::bootstrap-4')}}
    </body>
</html>
