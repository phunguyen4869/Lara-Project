<?php

namespace App\Http\Services\Cart;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getProducts()
    {
        $carts = Session::get('carts');

        if (empty($carts['products'])) {
            return null;
        }

        $productIds = array_keys($carts['products']);

        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')->whereIn('id', $productIds)->where('active', 1)->get();

        return $products;
    }

    public function countProducts()
    {
        $carts = Session::get('carts');

        if (empty($carts['products'])) {
            return 0;
        }

        return array_sum($carts['products']);
    }

    public function getQuantity()
    {
        $carts = Session::get('carts');

        if ($carts) {
            return $carts['products'];
        } else {
            return null;
        }
    }

    public function create($request)
    {
        $product_quantity = (int) $request->input('quantity');
        $product_id = $request->input('id');

        if ($product_quantity <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc thông tin sản phẩm không hợp lệ');
            return false;
        }

        $carts = Session::get('carts');

        if (is_null($carts)) {
            Session::put('carts', [
                'products' => [
                    $product_id => $product_quantity
                ]
            ]);

            return true;
        } else {
            if (array_key_exists($product_id, $carts['products'])) {
                $carts['products'][$product_id] += $product_quantity;

                Session::put('carts', $carts);

                return true;
            } else {
                $carts['products'][$product_id] = $product_quantity;

                Session::put('carts', $carts);

                return true;
            }
        }
    }

    public function update($request)
    {
        $product_quantity = (int) $request->input('quantity');
        $product_id = $request->input('id');

        $carts = Session::get('carts');

        if ($product_quantity == 0) {
            Session::forget('carts.products.' . $product_id);

            return null;
        }

        if (array_key_exists($product_id, $carts['products'])) {
            $carts['products'][$product_id] = $product_quantity;

            Session::put('carts', $carts);

            return true;
        } else {
            return false;
        }
    }

    public function total()
    {
        $carts = Session::get('carts');

        if (empty($carts['products'])) {
            return null;
        }

        $productIds = array_keys($carts['products']);

        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')->whereIn('id', $productIds)->where('active', 1)->get();

        $total = 0;

        foreach ($products as $product) {
            if (isset($product->price_sale)) {
                $price = $product->price_sale;
            } else {
                $price = $product->price;
            }
            $total += $price * $carts['products'][$product->id];
        }

        return $total;
    }

    public function removeProduct($productId)
    {
        $carts = Session::get('carts');

        if (array_key_exists($productId, $carts['products'])) {
            Session::forget('carts.products.' . $productId);

            return true;
        } else {
            return false;
        }
    }

    public function sendOrder($request)
    {

    }

    public function destroy()
    {
        Session::forget('carts');
    }
}
