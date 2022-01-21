@extends('main')

@section('content')
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filter
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
                            placeholder="Search">
                    </div>
                </div>

                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10" style="display: none;">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Sort By
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{ request()->url() }}" class="filter-link stext-106 trans-04">
                                        Default
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'asc']) }}"
                                        class="filter-link stext-106 trans-04">
                                        Price: Low to High
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'desc']) }}"
                                        class="filter-link stext-106 trans-04">
                                        Price: High to Low
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Price
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{ request()->url() }}" class="filter-link stext-106 trans-04">
                                        All
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['minPrice' => null, 'maxPrice' => '100000']) }}"
                                        class="filter-link stext-106 trans-04">
                                        $0.00 - $100,000.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['minPrice' => '100000', 'maxPrice' => '1000000']) }}"
                                        class="filter-link stext-106 trans-04">
                                        $100,000.00 - $1,000,000.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['minPrice' => '1000000', 'maxPrice' => '10000000']) }}"
                                        class="filter-link stext-106 trans-04">
                                        $1,000,000.00 - $10,000,000.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['minPrice' => '10000000', 'maxPrice' => '20000000']) }}"
                                        class="filter-link stext-106 trans-04">
                                        $10,000,000.00 - $20,000,000.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['minPrice' => '20000000', 'maxPrice' => null]) }}"
                                        class="filter-link stext-106 trans-04">
                                        $20,000,000.00+
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <h2>{{ $title }}</h2>
            <div class="row isotope-grid" style="position: relative; height: 1721.67px;">
                @foreach ($products as $products)
                    @foreach ($products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <a href="{{ url('product/' . $product->id . '-' . Str::slug($product->name)) }}">
                                        <img src="{!! App\Helpers\Helper::separateImage($product->thumb) !!}" alt="IMG-PRODUCT">
                                    </a>

                                    <a style="cursor: pointer;"
                                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                                        onclick="showModal({{ $product->id }})">
                                        Quick View
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{ url('product/' . $product->id . '-' . Str::slug($product->name)) }}"
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{ $product->name }}
                                        </a>

                                        <span class="stext-105 cl3">
                                            {{ number_format($product->price) }}
                                        </span>
                                        <span class="stext-105 cl3">
                                            @if ($product->price_sale)
                                                {{ 'SALE: ' . number_format($product->price_sale) }}
                                            @endif
                                        </span>
                                    </div>

                                    {{-- <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04"
                                        src="/template/images/icons/icon-heart-01.png" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                        src="/template/images/icons/icon-heart-02.png" alt="ICON">
                                </a>
                            </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            {!! $products->links() !!}
        </div>
    </div>
@endsection
