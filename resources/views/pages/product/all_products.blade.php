@extends('layouts.master')

@section('content')

<div class="container mt-5">
    <div class="row">
        <!-- Start Sidebar -->
        <div class="col-md-4">
            @include('partials.product-sidebar')
        </div>
        <!-- End Sidebar -->

        <!-- Start col-md-8 -->
        <div class="col-md-8">
            @include('partials.product-widget')
        </div>
    </div> <!-- end .row -->
    @endsection