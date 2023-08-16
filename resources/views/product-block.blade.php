<div class="col-12 col-sm-4 mt-3">
    <a href="{{ $product->fullUrl }}"></a>
    <div class="card">
        <a href="{{ $product->fullUrl }}">
            @if ($product->discount_price !== null)
                <div class="ribbon-wrapper">
                    <div class="ribbon  green">{{ __('insyht-larvelous-shop::translations.sale') }}</div>
                </div>
            @endif
            <img src="{{url($product->main_image)}}" class="card-img-top" alt="...">
        </a>
        <div class="card-body">
            <a href="{{ $product->fullUrl }}">
                <h5 class="card-title text-center">{{ $product->title }}</h5>
                <p class="card-text text-center">
                    @if ($product->discount_price !== null)
                        <s>€ {{ $product->price }}</s> € {{ $product->discount_price }}
                    @else
                        € {{ $product->price }}
                    @endif
                </p>
            </a>
            <button onclick="addToCart({{ $product->id }});" class="btn btn-primary btn-lg col-12"><i class="bi
            bi-bag"></i></button>
        </div>
    </div>

</div>
