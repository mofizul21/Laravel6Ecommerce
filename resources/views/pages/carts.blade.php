@extends('layouts.master')

@section('title')
My Cart Ietms
@endsection

@section('content')
<div class="container margin-top-20">
    <div class="row">
        <div class="col-md-12">
            <h2>My Cart Ietms</h2>
            @if (App\Cart::totalItems() > 0)
            @include('partials.message')
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Sub-total Price</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_price = 0;
                    @endphp
                    @foreach (App\Cart::totalCarts() as $cart)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td><a href="{{URL::to('/products/'.$cart->product->slug)}}">{{$cart->product->title}}</a></td>
                        <td>
                            @if ($cart->product->images->count() > 0)
                                <img src="{{asset('public/images/products/'.$cart->product->images->first()->image)}}" alt="Product Image" height="50">
                            @endif
                        </td>
                        <td>
                            <form class="form-inline" action="{{route('carts.update', $cart->id)}}" method="POST">
                                @csrf
                                <input type="number" name="product_quantity" class="form-control mr-sm-2" value="{{$cart->product_quantity}}">
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </td>
                        <td>{{$cart->product->price}} Taka</td>

                        @php
                            $total_price += $cart->product->price * $cart->product_quantity;
                        @endphp

                        <td>{{$cart->product->price * $cart->product_quantity}} Taka</td>
                        <td>
                            <form class="form-inline" action="{{route('carts.delete', $cart->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="cart_id" value="">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sure to delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                        <td><strong>Total Amount:</strong> </td>
                        <td colspan="2"><strong>{{$total_price}}</strong> Taka</td>
                    </tr>
                </tbody>
            </table>
            <div class="float-right">
                <a href="{{route('products')}}" class="btn btn-info btn-lg">Continue Shopping</a>
                <a href="{{route('checkouts')}}" class="btn btn-warning btn-lg">Checkout</a>
            </div>
            @else
            <h2 class="text-center alert alert-warning mt-4">Your cart is empty, <a href="{{route('products')}}">lets shopping...</a></h2>
            @endif
        </div>
    </div>
</div>
@endsection