@extends('nav')

@section('content')
    <div class="pinDetailContainer">
        <div class="bigContainer">
            <img class="detailImage" src="{{Storage::url($pin->pin_url)}}" alt="">
            <div class="pinUser" >
                <img class="homeProfile" src="{{Storage::url($user->user_url)}}" style="margin-left: 0; width: 5vw; height: 5vw" alt="">
                <h2>{{$user->user_name}}</h2>

                <a href="{{ route('update_pin_page', ['pin_id'=>$pin->pin_id]) }}" style="margin-left: auto; margin-right: 1vw">
                    <button class="saveBtn">
                        Edit Pin
                    </button>
                </a>
                <form action="{{ route('delete_pin', ['pin_id'=>$pin->pin_id]) }}" style="margin-right: 2vw;" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="saveBtn" style="background-color: gray">
                        Delete Pin
                    </button>
                </form>
            </div>
            <div class="pinDesc">
                <h1>{{$pin->pin_title}}</h1>
                <p>{{$pin->pin_desc}}</p>
            </div>
            <div class="pinComments" style="display: flex; flex-direction: column">
                <h2>Comments</h2>
                @if($comments->isEmpty())
                    <div style="text-align: center; margin: 3vh">
                        <h3 style="color: gray; font-weight: 400">No Comments</h3>
                    </div>
                @endif
                @foreach ($comments as $comment)
                    <div style="display: flex; justify-content: left; width: 80%; padding-left: 2vw; align-items: center;margin-bottom: 3vh">
                        <img src="{{Storage::url($comment->commenter->user_url)}}" alt="" class="homeProfile" style="width: 3vw; height: 3vw;">
                        <div style="display: flex; flex-direction: column; text-align:left; ">
                            <h3>{{$comment->commenter->user_name}}</h3>
                            <p>{{$comment->comment}}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <form action="{{ route('comment', ['user_id'=>Auth::id(), 'pin_id'=>$pin->pin_id]) }}" method="POST" style="display: flex; align-items: center;padding-left: 2vw; padding-bottom: 1vw">
                @csrf

                <img src="{{ Storage::url(Auth::user()->user_url) }}" alt="" class="homeProfile">
                <input type="text" placeholder="Add Comment..." name="comment" class="commentField">
                <button type="submit" class="commentBtn" style="height: 6vh">+</button>
            </form>
            @if ($errors->any())
                <p style="color: red;margin-bottom: 3vh" class="startError">
                {{$errors->first()}}
                </p>
            @endif
        </div>
    </div>
@endsection
