<?php

namespace Insyht\LarvelousShop\Helpers;

use Insyht\LarvelousShop\Models\Product;
use Insyht\LarvelousShop\Models\Wishlist;

class WishlistHelper
{
    public function addToWishlist(Product $product): bool
    {
        $wishlist = $this->getWishlist();
        $oldWishlist = clone $wishlist;

        $wishlist->addProduct($product);
        $this->saveWishlist($wishlist);

        return ($oldWishlist->addProduct($product) == $this->getWishlist());
    }

    public function getWishlist(): Wishlist
    {
        return Wishlist::where('session_id', session()->getId())->firstOrCreate(['session_id' => session()->getId()]);
    }

    public function saveWishlist(Wishlist $wishlist): bool
    {
        return $wishlist->save();
    }
}
