<?php

namespace Insyht\LarvelousShop\Helpers;

use Insyht\LarvelousShop\Models\Product;
use Insyht\LarvelousShop\Models\Cart;

class CartHelper
{
    public function addToCart(Product $product, int $amount): bool
    {
        $cart = $this->getCart();
        $oldCart = clone $cart;

        $cart->addProduct($product, $amount);
        $this->saveCart($cart);

        return ($oldCart->addProduct($product, $amount) == $this->getCart());
    }

    public function getCart(): Cart
    {
        return Cart::where('session_id', session()->getId())->firstOrCreate(['session_id' => session()->getId()]);
    }

    public function saveCart(Cart $cart): bool
    {
        return $cart->save();
    }
}
