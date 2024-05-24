@extends('nav_admin')

@section('content')
    <div class="pinList">
        @foreach ($users as $user)
            <div class="pinContainer" style="position: relative">
                    <img src="{{ Storage::url($user->user_url) }}" alt="asd" class="homePin">
                    <p class="homePinTitle">{{ $user->user_name }}</p>
                <form action="{{ route('admin_delete_user', ['user_id'=>$user->user_id]) }}" method="POST" class="adminDeleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="adminDeleteBtn">Delete User</button>
                </form>
            </div>
        @endforeach
    </div>
    {{$users->Links('pagination::bootstrap-4')}}
@endsection
