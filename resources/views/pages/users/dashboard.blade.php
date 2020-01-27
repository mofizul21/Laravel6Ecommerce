@extends('pages.users.master')

@section('title')
User Dashboard
@endsection

@section('sub-content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2>Welcome {{$user->first_name.' '.$user->last_name}}</h2>
            <p>You can manage your profile and everything from here.</p>
            <hr>
        </div>
    </div>



</div>
@endsection