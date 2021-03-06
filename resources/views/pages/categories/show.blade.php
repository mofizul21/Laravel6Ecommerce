@extends('layouts.master')

@section('content')
<div class="container margin-top-20">
    <div class="row">
        <!-- Start Sidebar -->
        <div class="col-md-4">
            @include('partials.product-sidebar')
        </div>
        <!-- End Sidebar -->

        <!-- Start Container -->
        <div class="col-md-8">
            <div class="widget">
                @php
                    $products = $category->products()->paginate(2);
                @endphp
                
                @if ($products->count() > 0)

                <h3>All Products in <span class="badge badge-primary">{{$category->name}}</span></h3>

                <div class="row">
                                              
                        
                    @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card">
                            @php $i = 1; @endphp
                            @foreach ($product->images as $image)
                            @if ($i > 0)
                            <img class="card-img-top" src="{{asset('public/images/products/'.$image->image)}}"
                                alt="Card image">
                            @endif
                            @php $i--; @endphp
                            @endforeach

                            <div class="card-body">
                                <a href="{{URL::to('/products/'.$product->slug)}}">
                                    <h4 class="card-title">{{$product->title}}</h4>
                                </a>
                                <p class="card-text">BDT. {{$product->price}}</p>
                                <a href="#" class="btn btn-outline-warning">Add to Cart</a>
                            </div>
                        </div>
                    </div> <!-- End .col-md-4 -->
                    @endforeach

                </div> <!-- End .row -->

                <div class="row">
                    <div class="col-md-8 mt-4">
                        {{ $products->links() }}
                    </div>
                </div>

                @else
                    <div class="alert alert-warning">Sorry! No products in the <strong>{{$category->name}}</strong> category</div>
                @endif
            </div> <!-- End .widget -->

            <!-- End Container -->
        </div>
    </div> <!-- end .container -->
    @endsection