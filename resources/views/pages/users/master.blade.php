@extends('layouts.master')

@section('title')
User Dashboard
@endsection

@section('content')
<div class="container margin-top-20">
    <div class="row">
        <div class="col-md-4">
            <div class="list-group">
                <a href="" class="list-group-item"><img src="{{App\Helpers\ImageHelper::getUserImage(Auth::user()->id)}}" alt="Avatar"
                        class="img rounded-circle mx-auto d-block mb-3" height="150"></a>
                <a href="{{route('user.dashboard')}}" class="list-group-item {{Route::is('user.dashboard') ? 'active':''}}">Dashboard</a>
                <a href="{{route('user.profile')}}" class="list-group-item {{Route::is('user.profile') ? 'active':''}}">Update Profile</a>
                <a href="" class="list-group-item">Logout</a>
            </div>
        </div>
        <div class="col-md-8">
            @yield('sub-content')
        </div>
    </div>
</div>
@endsection