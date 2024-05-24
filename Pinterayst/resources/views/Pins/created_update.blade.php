@extends('nav')

@section('content')
    <div class="contentContainer">
        <div class="formText">
            <div class="appName" style="margin-top: 0">
                <h1>Edit Pin</h1>
            </div>
        </div>
        <form action="{{ route('update_pin', ['pin_id' => $pin->pin_id]) }}" method="POST" class="logRegis" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="profileContainer">
                <img src="{{Storage::url($pin->pin_url)}}" id="createImg"/>
            </div>
            <input type="file" id="createFile" name="pin_url" style="display: none" value="{{$pin->pin_url}}">
            <div class="formBox">
                <label for="pin_title" class="formLabel">Pin Title:</label>
                <input type="text" name="pin_title" placeholder="Your pin's title..." value="{{$pin->pin_title}}" class="formField">
            </div>
            <div class="formBox">
                <label for="pin_desc" class="formLabel">Pin Description:</label>
                <input type="text" name="pin_desc" placeholder="Your pin's description..." value="{{$pin->pin_desc}}" class="formField" style="height: 5vh">
            </div>
            <button class="formBtn" type="submit">Save Edits</button>
        </form>
        @if ($errors->any())
            <p style="color: red" class="startError">
            {{$errors->first()}}
            </p>
        @endif

    </div>
@endsection
