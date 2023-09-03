@foreach ($product->options as $option)
    @include('insyht-larvelous-shop::blocks.product.optionstypes.' . strtolower($option->type), ['product' => $product, 'option' => $option])
@endforeach
