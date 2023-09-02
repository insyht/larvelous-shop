@foreach ($product->options as $option)
    @include($templatePath . '.blocks.product.optionstypes.' . strtolower($option->type), ['product' => $product, 'option' => $option])
@endforeach
