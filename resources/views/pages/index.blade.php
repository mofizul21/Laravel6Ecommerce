@extends('layouts.master')

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($sliders as $slider)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="{{$loop->index == 0 ? 'active' : ''}}"></li>
        @endforeach
        
    </ol>
    <div class="carousel-inner">
        @foreach ($sliders as $slider)
        <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
            <img class="d-block w-100" src="public/images/sliders/{{$slider->image}}" alt="{{$slider->title}}">
            <div class="carousel-caption d-none d-md-block">
                <h5>{{$slider->title}}</h5>
                <a href="{{$slider->button_link}}" class="btn btn-success">{{$slider->button_text}}</a>
            </div>
        </div>
        @endforeach

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

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
            <!-- End col-md-8 -->
        </div>
    </div> <!-- end .row -->
    @endsection