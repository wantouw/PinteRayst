@extends('nav')

@section('content')
    <div class="contentContainer">
        <div class="profilePageContainer">
            <img class="profileImage" src="{{Storage::url(Auth::user()->user_url)}}" alt="">
            <h1 style="margin-top: 2vh">{{$user->user_name}}</h1>
            <p  style="margin-top: 1vh">{{$user->user_bio}}</p>
            <div style="display: flex">
                <form action="{{ route('update_profile_page', ['user_id'=>Auth::id()]) }}">
                    @csrf
                    <button class="formBtn" type="submit" style="margin-top: 3vh">Edit Profile</button>
                </form>
                <form action="{{ route('logout') }}" method="POST" style="align-items: center">
                    @csrf
                    <button class="grayBtn" style="margin-top: 3vh">Log Out</button>
                </form>
            </div>
        </div>
        <div class="profileContents">
            <h2 style="border-bottom: 3px solid black; margin-right: 3vw">Created</h2>
            <a href="{{ route('profile_saved', ['user_id'=>Auth::id()]) }}" style="text-decoration: none;color: black">
                <h2 style="margin-left: 3vw">Saved</h2>
            </a>
        </div>
        <div class="pinList" style="padding-top: 5vh">
            @foreach ($pins as $pin)
                <div class="pinContainer">
                    <a href="{{ route('created_pin_detail', ['pin_id'=>$pin->pin_id]) }}">
                        <img src="{{ Storage::url($pin->pin_url) }}" alt="asd" class="homePin">
                        <p class="homePinTitle">{{ $pin->pin_title }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    {{$pins->Links('pagination::bootstrap-4')}}
@endsection
