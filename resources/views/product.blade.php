@extends('insyht-larvelous::layouts.website')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-7">
            @include('insyht-larvelous-shop::blocks.product.images', ['product' => $product])
        </div>
        <div class="col-12 col-sm-5">
            <h1 class="h3">{{ $product->title }}</h1>
            <p class="d-none d-sm-block text-primary">
                @if ($product->discount_price)
                    <s>&euro; {{ $product->price }}</s>
                    {{ $product->discount_price }}
                    @else
                    {{ $product->price }}
                @endif
            </p>
            @include('insyht-larvelous-shop::blocks.product.options', ['product' => $product])
            @include('insyht-larvelous-shop::blocks.product.buy', ['product' => $product])
            @include('insyht-larvelous-shop::blocks.product.intro', ['product' => $product])
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h2>{{ __('insyht-larvelous-shop::translations.productDescription') }}</h2>
        </div>
        <div class="col">
            @include('insyht-larvelous-shop::blocks.product.paragraphs', ['product' => $product])
        </div>
    </div>

    <div class="row">
        <div class="col-12"><p class="h3">{{ __('insyht-larvelous-shop::translations.relatedProducts') }}</p></div>
        @foreach ($product->related as $relatedProduct)
            @include('insyht-larvelous-shop::blocks.product.product', ['product' => $relatedProduct])
        @endforeach
    </div>
@endsection
