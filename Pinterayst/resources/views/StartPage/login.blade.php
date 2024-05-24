<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pinterayst</title>
    <link rel="stylesheet" href="{{ asset('css/start.css')}}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div class="formText">
        <div class="appName">
            <img src="{{ asset('images/logo.png') }}" alt="">
            <h1>Pinterayst</h1>
        </div>
        <h2>Log In</h2>
    </div>
    {{-- <div class="logRegis">
        <div class="formBox">
            <label for="user_name" class="formLabel">Username:</label>
            <input type="text" name="user_name" placeholder="Username" class="formField">
        </div>
        <div class="formBox">
            <label for="user_password" class="formLabel">Password:</label>
            <input type="password" name="user_password" placeholder="Password" class="formField">
        </div>
        <div style="display: flex">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <button class="formBtn" type="submit">Log In</button>
            </form>
            <form action="{{ route('guest_home') }}">
                @csrf
                <button class="formBtn" type="submit" style="background-color: gray">As Guest</button>
            </form>

        </div>
    </div> --}}
    <form action="{{ route('login') }}" method="POST" class="logRegis">
        @csrf
        <div class="formBox">
            <label for="user_name" class="formLabel">Username:</label>
            <input type="text" name="user_name" placeholder="Username" class="formField">
        </div>
        <div class="formBox">
            <label for="user_password" class="formLabel">Password:</label>
            <input type="password" name="user_password" placeholder="Password" class="formField">
        </div>
        <button class="formBtn" type="submit">Log In</button>
    </form>
    <form action="{{ route('guest_home') }}" style="display: flex; justify-content: center">
        @csrf
        <button class="grayBtn" type="submit">Enter as guest</button>
    </form>
    @if ($errors->any())
        <p style="color: red" class="startError">
           Invalid credentials!
        </p>
    @endif
    <div class="formText">
        <p>New User? <a href="{{ route('regis_page') }}">Register here</a></p>
    </div>
</body>
</html>
