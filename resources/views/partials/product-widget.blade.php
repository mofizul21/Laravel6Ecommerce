<div class="widget">
    @include('partials.message')
    <h3>All Products</h3>
    <div class="row">

        @foreach ($products as $product)
        <div class="col-md-4 mt-3">
            <div class="card">
                @php $i = 1; @endphp
                @foreach ($product->images as $image)
                @if ($i > 0)
                <img class="card-img-top" src="{{asset('public/images/products/'.$image->image)}}" alt="Card image">
                @endif
                @php $i--; @endphp
                @endforeach

                <div class="card-body">
                    <a href="{{URL::to('/products/'.$product->slug)}}">
                        <h4 class="card-title">{{$product->title}}</h4>
                    </a>
                    <p class="card-text">BDT. {{$product->price}}</p>
                    @include('partials.cart-button')
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

</div> <!-- End .widget -->