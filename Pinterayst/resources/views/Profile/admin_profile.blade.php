@extends('nav_admin')

@section('content')
    <div class="contentContainer">
        <div class="profilePageContainer">
            <img class="profileImage" src="{{Storage::url(Auth::user()->user_url)}}" alt="">
            <h1 style="margin-top: 2vh">admin</h1>
            <div style="display: flex">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="formBtn" style="margin-top: 3vh; background-color: gray">Log Out</button>
                </form>
            </div>
        </div>
    </div>
@endsection
