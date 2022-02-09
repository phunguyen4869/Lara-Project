<?php

namespace App\Http\Controllers;

use App\Http\Services\Cart\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function showCart()
    {
        // $this->cart->destroy();
        $products = $this->cart->getProducts();
        $quantity = $this->cart->getQuantity();
        $total = $this->cart->total();

        return view('cart_list', [
            'title' => 'Cart',
            'products' => $products,
            'quantity' => $quantity,
            'total' => $total
        ]);
    }

    public function addToCart(Request $request)
    {
        $result = $this->cart->create($request);
        $productQuantity = $this->cart->countProducts();

        if ($result) {
            return response()->json([
                'status' => true,
                'quantity' => $productQuantity
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function updateCart(Request $request)
    {
        $result = $this->cart->update($request);
        $productQuantity = $this->cart->countProducts();
        $total = $this->cart->total();

        if ($result) {
            return response()->json([
                'status' => true,
                'quantity' => $productQuantity,
                'total' => $total,
                'message' => 'Cart updated successfully'
            ]);
        } elseif ($result == null) {
            return response()->json([
                'status' => null,
                'quantity' => $productQuantity,
                'total' => $total,
                'message' => 'Product deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'quantity' => $productQuantity,
                'message' => 'Cart updated failed'
            ]);
        }
    }

    public function removeProduct(Request $request)
    {
        $productsId = $request->input('id');

        $result = $this->cart->removeProduct($productsId);
        $productQuantity = $this->cart->countProducts();
        $total = $this->cart->total();

        if ($result) {
            return response()->json([
                'status' => true,
                'quantity' => $productQuantity,
                'total' => $total,
                'message' => 'Product deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'quantity' => $productQuantity,
                'message' => 'Product not exist'
            ]);
        }
    }

    public function checkOut(Request $request)
    {
        if ($request->user() != null) {
            $user = $request->user();
        } else {
            $user = null;
        }
        $products = $this->cart->getProducts();
        $quantity = $this->cart->getQuantity();
        $total = $this->cart->total();

        return view('checkout', [
            'title' => 'Checkout',
            'products' => $products,
            'quantity' => $quantity,
            'total' => $total,
            'user' => $user
        ]);
    }

    public function sendOrder(Request $request)
    {
        if ($request->user() != null) {
            $user = $request->user();
        } else {
            $user = null;
        }

        $result = $this->cart->sendOrder($request, $user);  

        if ($result) {
            return redirect()->back()->with('success', 'Đã đặt hàng thành công');
        } else {
            return redirect()->back()->with('error', 'Đặt hàng thất bại');
        }
    }
}
