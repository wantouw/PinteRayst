@extends('nav')

@section('content')
    <div style="padding-top: 11vh">
        <div class="formText">
            <div class="appName" style="margin-top: 0">
                <h1>Edit Profile</h1>
            </div>
        </div>
        <form action="{{ route('update_profile', ['user_id' => $user->user_id]) }}" method="POST" class="logRegis" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="profileContainer">
                <img src="{{Storage::url($user->user_url)}}" id="profileImg" style="width: 30vw; height: 30vw"/>
            </div>
            <input type="file" id="profileFile" name="user_url" style="display: none">
            <div class="formBox">
                <label for="user_name" class="formLabel">Username:</label>
                <input type="text" name="user_name" placeholder="Username" class="formField" value="{{$user->user_name}}">
            </div>
            <div class="formBox">
                <label for="user_email" class="formLabel">E-mail:</label>
                <input type="text" name="user_email" placeholder="E-mail address" class="formField" value="{{$user->user_email}}">
            </div>
            <div class="formBox">
                <label for="user_dob" class="formLabel">Date of birth:</label>
                <input type="date" name="user_dob" placeholder="Date of birth" class="formField" value="{{$user->user_dob}}">
            </div>
            <div class="formBox">
                <label for="user_bio" class="formLabel">Bio:</label>
                <input type="text" name="user_bio" placeholder="Write something fun.." class="formField" style="height: 5vh" value="{{$user->user_bio}}">
            </div>
            <button class="formBtn" type="submit">Edit Profile</button>
        </form>
        @if ($errors->any())
            <p style="color: red" class="startError">
            {{$errors->first()}}
            </p>
        @endif

    </div>
@endsection
