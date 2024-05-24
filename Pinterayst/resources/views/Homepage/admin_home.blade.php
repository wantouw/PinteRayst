@extends('nav_admin')

@section('content')
    <div class="pinList">
        @foreach ($pins as $pin)
            <div class="pinContainer" style="position: relative">
                <a href="{{ route('admin_pin_detail', ['pin_id'=>$pin->pin_id]) }}">
                    <img src="{{ Storage::url($pin->pin_url) }}" alt="asd" class="homePin">
                    <p class="homePinTitle">{{ $pin->pin_title }}</p>
                </a>
                <form method="POST" action="{{ route('admin_delete_pin', ['pin_id'=>$pin->pin_id]) }}" class="adminDeleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="adminDeleteBtn">Delete Pin</button>
                </form>
            </div>
        @endforeach
    </div>
    {{$pins->Links('pagination::bootstrap-4')}}
@endsection
