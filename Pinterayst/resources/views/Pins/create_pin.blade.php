@extends('nav')

@section('content')
    <div class="contentContainer">
        <div class="formText">
            <div class="appName" style="margin-top: 0">
                <h1>Create Pin</h1>
            </div>
            <h2>Show your ideas with the world!</h2>
        </div>
        <form action="{{ route('create') }}" method="POST" class="logRegis" enctype="multipart/form-data">
            @csrf

            <div class="profileContainer">
                <img src="http://via.placeholder.com/150x150" id="createImg"/>
            </div>
            <input type="file" id="createFile" name="pin_url" style="display: none">
            <div class="formBox">
                <label for="pin_title" class="formLabel">Pin Title:</label>
                <input type="text" name="pin_title" placeholder="Your pin's title..." class="formField">
            </div>
            <div class="formBox">
                <label for="pin_desc" class="formLabel">Pin Description:</label>
                <input type="text" name="pin_desc" placeholder="Your pin's description..." class="formField" style="height: 5vh">
            </div>
            <button class="formBtn" type="submit">Create</button>
        </form>
        @if ($errors->any())
            <p style="color: red" class="startError">
            {{$errors->first()}}
            </p>
        @endif
    </div>
@endsection
