@extends('layouts.master')

@section('title')
Checkout
@endsection

@section('content')

<div class="container margin-top-20">
    <div class="row">
        <div class="col-md-7">
            <div class="card card-body">
                <h2>Confirm Item(s)</h2>
                <hr>
                @foreach (App\Cart::totalCarts() as $cart)
                <p>{{$cart->product->title}} - <strong>{{$cart->product->price}}</strong> Taka -
                    {{$cart->product_quantity}} item</p>
                @endforeach
                <p><a href="{{route('carts')}}" class="btn btn-dark">Change Cart Items</a></p>
            </div>
        </div>

        <div class="col-md-5 text-center">
            <div class="card card-body">
                @php
                $total_price = 0;
                @endphp
                @foreach (App\Cart::totalCarts() as $cart)
                @php
                $total_price += $cart->product->price * $cart->product_quantity;
                @endphp
                @endforeach
                <p class="lead">Total Price:</p>
                <h1 class="h1">{{number_format($total_price)}} <span>taka</span></h1>
                <hr>
                <p class="lead">Total Price with Shipping Cost:</p>
                <h1 class="h1">{{number_format($total_price + App\Setting::first()->shipping_cost)}} <span>taka</span>
                </h1>
            </div>
        </div>
    </div>

    <div class="mt-3">
        @include('partials.message')
    </div>

    <div class="row>
        <div class="col-md-12">
            <div class="card card-body">
                <h2>Shipping Address</h2>
                <hr>
                <form method="POST" action="{{ route('checkouts.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="first_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Receiver Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{Auth::check() ? Auth::user()->first_name : ''}}"
                                autocomplete="name">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{Auth::check() ? Auth::user()->email : ''}}" autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_no"
                            class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>

                        <div class="col-md-6">
                            <input id="phone_no" type="text"
                                class="form-control @error('phone_no') is-invalid @enderror" name="phone_no"
                                value="{{Auth::check() ? Auth::user()->phone_no : ''}}" autocomplete="phone_no">

                            @error('phone_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="shipping_address"
                            class="col-md-4 col-form-label text-md-right">{{ __('Shpping Address(*)') }}</label>

                        <div class="col-md-6">
                            <textarea id="shipping_address"
                                class="form-control @error('shipping_address') is-invalid @enderror"
                                name="shipping_address"
                                autocomplete="shipping_address">{{Auth::check() ? Auth::user()->shipping_address : ''}}</textarea>

                            @error('shipping_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message"
                            class="col-md-4 col-form-label text-md-right">{{ __('Additional Message (Optional)') }}</label>

                        <div class="col-md-6">
                            <textarea id="message"
                                class="form-control @error('message') is-invalid @enderror"
                                name="message"
                                autocomplete="message"></textarea>

                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment_method"
                            class="col-md-4 col-form-label text-md-right">{{ __('Payment Method') }}</label>

                        <div class="col-md-6">
                            <select name="payment_method_id" class="form-control" id="payments">
                                <option value="">Select a payment method</option>
                                @foreach ($payments as $payment)
                                <option value="{{$payment->short_name}}">{{$payment->name}}</option>
                                @endforeach
                            </select>

                            @foreach ($payments as $payment)
                                @if ($payment->short_name == 'cash_in')
                                    <div id="payment_{{$payment->short_name}}" class="hidden">
                                        <div class="card card-body mt-3 animated fadeInRight">
                                            <h3>Nothing to payment. Just click on the 'Order Now' button. We'll call you to
                                                confirm
                                                order.</h3>
                                            <small>You will get your products within 2/3 business days.</small>
                                        </div>
                                    </div>

                                    @else
                                    <div id="payment_{{$payment->short_name}}" class="hidden">
                                        <div class="card card-body mt-3 animated fadeInRight">
                                            <h3>{{$payment->name}} Payment</h3>
                                            <p>
                                                <strong>{{$payment->name}} No: {{$payment->no}}</strong>
                                                <br>
                                                <strong>Account Type: {{$payment->type}}</strong>
                                            </p>

                                            <div class="alert alert-success">Please send above money into the {{$payment->name}}
                                                number and insert the Trx ID:</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <input type="text" name="transaction_id" id="transaction_id" class="form-control hidden" placeholder="Enter Trx ID">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Order Now') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
@endsection

<style>
    .h1 span {
        font-size: 15px;
    }

    /*Animate CSS*/
    .animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            -webkit-transform: translate3d(100%, 0, 0);
            transform: translate3d(100%, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .fadeInRight {
        -webkit-animation-name: fadeInRight;
        animation-name: fadeInRight;
    }
</style>