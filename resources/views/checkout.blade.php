@extends('main')

@section('content')
@include('alert')
    <form action="#" class="bg0 p-t-75 p-b-85" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-5">Quantity</th>
                                    <th class="column-5">Total</th>
                                    <th class="column-2"></th>
                                </tr>

                                @if (!is_null($products))
                                    @foreach ($products as $product)
                                        <tr class="table_row" id="table_row_{{ $product->id }}">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="{{ App\Helpers\Helper::separateImage($product->thumb) }}"
                                                        alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2">
                                                <a href="product/{{ $product->id }}-{{ Str::slug($product->name) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </td>
                                            @php
                                                $price_final = App\Helpers\Helper::price($product->price, $product->price_sale);
                                            @endphp
                                            <td class="column-3">₫{{ number_format($price_final) }}</td>
                                            <input type="hidden" id="product_price" value="{{ $price_final }}">

                                            <td class="column-5">
                                                {{ $quantity[$product->id] }}
                                            </td>

                                            <td class="column-5 totalPrice" id="total_product_price_{{ $product->id }}">
                                                ₫{{ number_format($price_final * $quantity[$product->id]) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="table_row">
                                        <td class="column-1" colspan="5">
                                            <div class="alert alert-danger" role="alert">
                                                <strong>Bạn "khum" có sản phẩm nào trong giỏ hàng!</strong>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        {{-- <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                    name="coupon" placeholder="Coupon Code">

                                <div
                                    class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Apply coupon
                                </div>
                            </div>

                            <div
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                Update Cart
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Cart Totals
                        </h4>

                        {{-- <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Subtotal:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2 subTotal">
                                    @if (isset($total))
                                        ₫{{ number_format($total) }}
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Shipping:
                                </span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    There are no shipping methods available. Please double check your address, or contact us
                                    if you need any help.
                                </p>

                                <div class="p-t-15">
                                    <span class="stext-112 cl8">
                                        Calculate Shipping
                                    </span>

                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="time">
                                            <option>Select a country...</option>
                                            <option>USA</option>
                                            <option>UK</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>

                                    <div class="bor8 bg0 m-b-12">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state"
                                            placeholder="State /  country">
                                    </div>

                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode"
                                            placeholder="Postcode / Zip">
                                    </div>

                                    <div class="flex-w">
                                        <div
                                            class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                            Update Totals
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> --}}

                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">
                                    Total:
                                </span>
                            </div>

                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2 total" id="cartTotal">
                                    @if (isset($total))
                                        ₫{{ number_format($total) }}
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name"
                                    value="{{ $user != null ? $user->name : '' }}" placeholder="Name" required>
                            </div>

                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="email"
                                    value="{{ $user != null ? $user->email : '' }}" placeholder="Email" required>
                            </div>

                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="tel" name="phone"
                                    value="{{ $user != null ? $user->phone : '' }}" placeholder="Phone" required>
                            </div>

                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address"
                                    value="{{ $user != null ? $user->address : '' }}" placeholder="Address" required>
                            </div>

                            <div class="bor8 bg0 m-b-12">
                                <select name="payment_method" id="payment_method" class="form-control">
                                    <option value="credit_card" @if ($user != null && $user->payment_method == 'credit_card')
                                        selected="selected"
                                        @endif>Thẻ tín dụng</option>
                                    <option value="atm_card" @if ($user != null && $user->payment_method == 'atm_card')
                                        selected="selected"
                                        @endif>Thẻ ATM nội địa</option>
                                    <option value="cod" @if ($user == null || $user->payment_method == 'cod')
                                        selected="selected"
                                        @endif>Thanh toán khi nhận hàng</option>
                                </select>
                            </div>
                            <div @if (($user != null && $user->payment_method != 'credit_card') || $user == null)
                                class="flex-w flex-t bor12 p-t-15 p-b-30 hidden"
                            @else
                                class="flex-w flex-t bor12 p-t-15 p-b-30"
                                @endif id="credit_card">
                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="credit_card_number"
                                        value="{{ $user != null ? $user->credit_card_number : '' }}"
                                        placeholder="Card number">
                                </div>

                                <div class="bor8 bg0 m-b-12" style="width: 70%;">
                                    <input type="text" name="expiration_date" placeholder="Expiration date"
                                        value="{{ $user != null ? $user->expiration_date : '' }}"
                                        class="stext-111 cl8 plh3 size-111 p-lr-15" />
                                </div>

                                <div class="bor8 bg0 m-b-12" style="width: 30%;">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="cvv_code"
                                        value="{{ $user != null ? $user->cvv_code : '' }}" placeholder="CVV">
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="credit_card_name"
                                        value="{{ $user != null ? $user->credit_card_name : '' }}" placeholder="Name">
                                </div>
                            </div>

                            <div @if (($user != null && $user->payment_method != 'atm_card') || $user == null)
                                class="flex-w flex-t bor12 p-t-15 p-b-30 hidden"
                            @else
                                class="flex-w flex-t bor12 p-t-15 p-b-30"
                                @endif id="atm_card">
                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="atm_card_number"
                                        value="{{ $user != null ? $user->atm_card_number : '' }}"
                                        placeholder="Card number">
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="bank_name"
                                        value="{{ $user != null ? $user->bank_name : '' }}" placeholder="Bank name">
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="atm_card_name"
                                        value="{{ $user != null ? $user->atm_card_name : '' }}" placeholder="Name">
                                </div>
                            </div>
                            <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @csrf
    </form>
@endsection
