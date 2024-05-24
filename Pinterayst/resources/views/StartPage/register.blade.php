<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pinterayst</title>
    <link rel="stylesheet" href="{{ asset('css/start.css')}}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="{{ asset('js/start.js') }}" defer></script>
</head>
<body>

    <div class="formText">
        <div class="appName">
            <img src="{{ asset('images/logo.png') }}" alt="">
            <h1>Pinterayst</h1>
        </div>
        <h2>Register</h2>
    </div>
    <form action="{{ route('regis') }}" method="POST" class="logRegis" enctype="multipart/form-data">
        @csrf

        <div class="profileContainer">
            <img src="http://via.placeholder.com/150x150" id="profileImg"/>
        </div>
        <input type="file" id="profileFile" name="user_url" style="display: none">
        <div class="formBox">
            <label for="user_name" class="formLabel">Username:</label>
            <input type="text" name="user_name" placeholder="Username" class="formField">
        </div>
        <div class="formBox">
            <label for="user_password" class="formLabel">Password:</label>
            <input type="password" name="user_password" placeholder="Password" class="formField">
        </div>
        <div class="formBox">
            <label for="user_email" class="formLabel">E-mail:</label>
            <input type="text" name="user_email" placeholder="E-mail address" class="formField">
        </div>
        <div class="formBox">
            <label for="user_dob" class="formLabel">Date of birth:</label>
            <input type="date" name="user_dob" placeholder="Date of birth" class="formField">
        </div>
        <div class="formBox">
            <label for="user_bio" class="formLabel">Bio:</label>
            <input type="text" name="user_bio" placeholder="Write something fun.." class="formField" style="height: 5vh">
        </div>
        <button class="formBtn" type="submit">Register</button>
    </form>
    @if ($errors->any())
        <p style="color: red" class="startError">
           {{$errors->first()}}
        </p>
    @endif
    <div class="formText">
        <p>Have an account already? <a href="{{ route('start')}}">Log in here</a></p>
    </div>

</body>
</html>
