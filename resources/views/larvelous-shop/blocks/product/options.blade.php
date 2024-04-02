@foreach ($product->options as $option)
    @include('larvelous-shop.blocks.product.optionstypes.' . strtolower($option->type), ['product' => $product, 'option' => $option])
@endforeach
