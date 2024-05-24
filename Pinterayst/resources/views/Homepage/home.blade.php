

@extends('nav')

@section('content')
    <div class="pinList">
        @foreach ($pins as $pin)
            <div class="pinContainer">
                @if($pin->user_id === Auth::id())
                    <a href="{{ route('created_pin_detail', ['pin_id'=>$pin->pin_id]) }}">
                        <img src="{{ Storage::url($pin->pin_url) }}" alt="asd" class="homePin">
                        <p class="homePinTitle">{{ $pin->pin_title }}</p>
                    </a>
                @else
                    <a href="{{ route('pin_detail', ['pin_id'=>$pin->pin_id]) }}">
                        <img src="{{ Storage::url($pin->pin_url) }}" alt="asd" class="homePin">
                        <p class="homePinTitle">{{ $pin->pin_title }}</p>
                    </a>
                @endif
            </div>
        @endforeach
    </div>
    {{$pins->Links('pagination::bootstrap-4')}}
@endsection
