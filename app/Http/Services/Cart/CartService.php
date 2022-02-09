<?php

namespace App\Http\Services\Cart;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function getCart()
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

    public function sendOrder($request, $user)
    {
        try {
            DB::beginTransaction();

            if (!empty($user)) {
                $userPayment = $user->payment_method;
                $requestPayment = $request->payment_method;
                $customer_id = $user->id;

                if ($userPayment == $requestPayment) {
                    $paymentMethod = $userPayment;
                } else {
                    $paymentMethod = $requestPayment;
                }

                $customer = Customer::find($customer_id);

                if (empty($customer)) {
                    $customer = Customer::create([
                        'id' => $customer_id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'address' => $user->address,
                        'credit_card_number' => $user->credit_card_number,
                        'expiration_date' => $user->expiration_date,
                        'cvv_code' => $user->cvv_code,
                        'credit_card_name' => $user->credit_card_name,
                        'atm_card_number' => $user->atm_card_number,
                        'bank_name' => $user->bank_name,
                        'atm_card_name' => $user->atm_card_name,
                    ]);
                }
            } else {
                $customer = Customer::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'credit_card_number' => $request->input('credit_card_number'),
                    'expiration_date' => $request->input('expiration_date'),
                    'cvv_code' => $request->input('cvv_code'),
                    'credit_card_name' => $request->input('credit_card_name'),
                    'atm_card_number' => $request->input('atm_card_number'),
                    'bank_name' => $request->input('bank_name'),
                    'atm_card_name' => $request->input('atm_card_name'),
                ]);

                $paymentMethod = $request->payment_method;

                $customer_id = $customer->id;
            }

            $cart = $this->getCart();

            foreach ($cart as $key => $value) {
                $product_id[] = $key;
                $product_quantity[] = $value;
            }

            $product_id = implode('&', $product_id);
            $product_quantity = implode('&', $product_quantity);

            Order::create([
                'product_id' => $product_id,
                'quantity' => $product_quantity,
                'total' => $this->total(),
                'payment_method' => $paymentMethod,
                'status' => 0,
                'customer_id' => $customer_id,
            ]);

            DB::commit();
            Session::forget('carts');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function destroy()
    {
        Session::forget('carts');
    }
}
