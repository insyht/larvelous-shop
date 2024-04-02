<div class="row">
    <div class="col">
        <div class="input-group input-group-md">
            <input class="form-control" value="1" min="1" max="999" type="number" name="amount">
            <button class="btn btn-primary pl-5 pr-5" data-product-id="{{ $product->id }}" onclick="addToCart(this);" type="button">
                <i class="bi bi-cart3"></i>
                {{ __('insyht-larvelous-shop::translations.placeInCart') }}
            </button>
        </div>
        <button class="btn btn-lg btn-outline-primary w-100 mt-3" type="button" onclick="addToWishlist(this);" data-product-id="{{ $product->id }}">
            <i class="bi bi-suit-heart"></i>
            {{ __('insyht-larvelous-shop::translations.addToWishlist') }}
        </button>

    </div>
</div>
