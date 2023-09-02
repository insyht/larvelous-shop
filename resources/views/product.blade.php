@extends('layouts.website')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-7">
            @include($templatePath . '.blocks.product.images', ['product' => $product])
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
            @include($templatePath . '.blocks.product.options', ['product' => $product])
            @include($templatePath . '.blocks.product.buy', ['product' => $product])
            @include($templatePath . '.blocks.product.intro', ['product' => $product])
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h2>{{ __('insyht-larvelous-shop::translations.productDescription') }}</h2>
        </div>
        <div class="col">
            @include($templatePath . '.blocks.product.paragraphs', ['product' => $product])
        </div>
    </div>

    <div class="row">
        <div class="col-12"><p class="h3">{{ __('insyht-larvelous-shop::translations.relatedProducts') }}</p></div>
        @foreach ($product->related as $relatedProduct)
            @include($templatePath . '.blocks.product.product', ['product' => $relatedProduct])
        @endforeach
    </div>
@endsection