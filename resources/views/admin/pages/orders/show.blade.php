@extends('admin.layouts.master')

@section('title')
View Order
@endsection

@section('content')
<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    @include('admin.partials.topbar')
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Order ID: #LE{{$order->id}}</h1>

        @include('admin.partials.message')

        <h3>Order Informations</h3>

        <div class="card card-body">
            <div class="row">
                <div class="col-md-6 border-right">
                    <p><strong>Orderer:</strong> {{$order->name}}</p>
                    <p><strong>Email:</strong> {{$order->email}}</p>
                    <p><strong>Phone:</strong> {{$order->phone_no}}</p>
                    <p><strong>Shipping Address:</strong> {{$order->shipping_address}}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Payment Method:</strong> {{$order->payment->name}}</p>
                    <p><strong>Transaction ID:</strong> {{$order->transaction_id}}</p>
                </div>
            </div>

            @if ($order->carts->count() > 0)
            <hr>
            <h3>Ordered Items</h3>
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
                    @foreach ($order->carts as $cart)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td><a href="{{URL::to('/products/'.$cart->product->slug)}}">{{$cart->product->title}}</a></td>
                        <td>
                            @if ($cart->product->images->count() > 0)
                            <img src="{{asset('public/images/products/'.$cart->product->images->first()->image)}}"
                                alt="Product Image" height="50">
                            @endif
                        </td>
                        <td>
                            <form class="form-inline" action="{{route('carts.update', $cart->id)}}" method="POST">
                                @csrf
                                <input min="1" type="number" name="product_quantity" class="form-control mr-sm-2"
                                    value="{{$cart->product_quantity}}">
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
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Sure to delete?')">Delete</button>
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
            @endif
        </div>

        <hr>

        <div class="row">
            <div class="col-md-2">
                <form action="{{route('admin.order.completed', $order->id)}}" method="POST">
                    @csrf
                    @if ($order->is_completed)
                    <input type="submit" class="btn btn-danger" value="Cancel Order">
                    @else
                    <input type="submit" class="btn btn-success" value="Mark as Completed">
                    @endif
                </form>
            </div>

            <div class="col-md-2">
                <form action="{{route('admin.order.paid', $order->id)}}" method="POST">
                    @csrf
                    @if ($order->is_paid)
                    <input type="submit" class="btn btn-danger" value="Cancel Payment">
                    @else
                    <input type="submit" class="btn btn-success" value="Paid Order">
                    @endif
                </form>
            </div>

        </div> <!-- .row end -->

        <hr>
        <div class="row">
            <div class="col-md-4 card card-body">
                <form action="{{route('admin.order.charge', $order->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Shipping Cost (taka):</label>
                        <input type="number" class="form-control" name="shipping_charge" value="{{$order->shipping_charge}}">
                    </div>
                    <div class="form-group">
                        <label for="">Custom Discount (taka):</label>
                        <input type="number" class="form-control" name="custom_discount" value="{{$order->custom_discount}}">
                    </div>
                    
                    <input type="submit" class="btn btn-success" value="Update">
                    <a target="_blank" href="{{route('admin.order.invoice', $order->id)}}" class="btn btn-dark ml-2">Generate Invoice</a>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection