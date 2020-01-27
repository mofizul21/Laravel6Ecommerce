@extends('layouts.master')

@section('title')
{{$product->title}}
@endsection

@section('content')
<div class="container margin-top-20">
    <div class="row">
        <!-- Start Sidebar -->
        <div class="col-md-4">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @php $i = 1; @endphp
                    @foreach ($product->images as $image)                        
                    <div class="carousel-item {{$i == 1 ? 'active' : ''}}">
                        <img class="d-block w-100" src="{{asset('public/images/products/'.$image->image)}}" alt="First slide">
                    </div>
                    @php $i++; @endphp
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Start Container -->
        <div class="col-md-8">
            <div class="widget">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title">{{$product->title}}</h4>                 <p>In <span class="badge badge-dark">{{$product->category->name}}</span> category and under <span class="badge badge-info">{{$product->brand->name}}</span> brand.</p>    
                        <p class="card-text">BDT. {{$product->price}} <span class="badge badge-primary">{{$product->quantity < 1 ? 'No item is available' : $product->quantity.' items in stock'}}</span></p>
                        @include('partials.cart-button')
                        
                        <br><br>
                        <p>{{$product->description}}</p>
                    </div>
                </div>

            </div> <!-- End .widget -->
        </div>
        <!-- End Container -->
    </div>
</div> <!-- end .container -->

<style>
.carousel-inner {
    background: #777;
}
</style>
@endsection