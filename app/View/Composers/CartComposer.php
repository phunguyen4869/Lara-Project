<?php

namespace App\View\Composers;

use App\Http\Services\Cart\CartService;
use Illuminate\View\View;

class CartComposer
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function compose(View $view)
    {
        $products = $this->cart->getProducts();
        $productQuantity = $this->cart->countProducts();
        $quantity = $this->cart->getQuantity();
        $total = $this->cart->total();

        $view->with([
            'products' => $products,
            'productQuantity' => $productQuantity,
            'quantity' => $quantity,
            'total' => $total
        ]);
    }
}
