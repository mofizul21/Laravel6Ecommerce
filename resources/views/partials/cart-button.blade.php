<form class="form-inline" action="{{route('carts.store')}}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <button type="button" onclick="addToCart({{$product->id}})" class="btn btn-outline-warning"><i class="fas fa-cart-plus"></i> Add to Cart</button> <!-- Except the button, another things is unncessary -->
</form>