(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'html',
        transition: function (url) {
            window.location.href = url;
        }
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height() / 2;

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display', 'flex');
        } else {
            $("#myBtn").css('display', 'none');
        }
    });

    $('#myBtn').on("click", function () {
        $('html, body').animate({
            scrollTop: 0
        }, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if ($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    } else {
        var posWrapHeader = 0;
    }


    if ($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top', 0);
    } else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top', 0);
        } else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
        }
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function () {
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for (var i = 0; i < arrowMainMenu.length; i++) {
        $(arrowMainMenu[i]).on('click', function () {
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function () {
        if ($(window).width() >= 992) {
            if ($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display', 'none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function () {
                if ($(this).css('display') == 'block') {
                    console.log('hello');
                    $(this).css('display', 'none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });

        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function () {
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity', '0');
    });

    $('.js-hide-modal-search').on('click', function () {
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity', '1');
    });

    $('.container-search-header').on('click', function (e) {
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({
                filter: filterValue
            });
        });

    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine: 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function () {
        $(this).on('click', function () {
            for (var i = 0; i < isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click', function () {
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if ($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }
    });

    $('.js-show-search').on('click', function () {
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if ($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click', function () {
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click', function () {
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click', function () {
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click', function () {
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function () {
        var numProduct = Number($(this).next().val());
        if (numProduct > 1) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function () {
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function () {
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function () {
            var index = item.index(this);
            var i = 0;
            for (i = 0; i <= index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function () {
            var index = item.index(this);
            rated = index;
            $(input).val(index + 1);
        });

        $(this).on('mouseleave', function () {
            var i = 0;
            for (i = 0; i <= rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });

    /*==================================================================
    [ Hide modal1 ]*/
    $('.js-hide-modal1').on('click', function () {
        $('.js-modal1').removeClass('show-modal1');

        $('.wrap-slick3').each(function () {
            $(this).find('.slick3').slick('unslick');
        });
    });

})(jQuery);

$(document).ready(function () {
    $('#page').val(1);
});

function showModal(id) {
    $.ajax({
        type: 'GET',
        datatype: 'json',
        data: {
            id
        },
        url: '/productModal',
        success: function (result) {
            if (result.error === false) {
                let thumbs = result.data.thumb.split(',');
                let html = '';
                $('.wrap-slick3').each(function () {
                    $(this).find('.slick3').slick('unslick');
                });

                $('.js-name-detail').text(result.data.name);
                $('.js-price').text(result.data.price);
                $('.js-description').text(result.data.description);
                $('.js-img').attr('src', result.data.thumb);
                $('.js-img-hr').attr('href', result.data.thumb);
                $('#input_product_id').val(result.data.id);

                for (let i = 0; i < thumbs.length; i++) {
                    html = html + '<div class="item-slick3" data-thumb="' + thumbs[i] + '"><div class="wrap-pic-w pos-relative"><img src="' + thumbs[i] + '" alt="IMG-PRODUCT"><a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="' + thumbs[i] + '"><i class="fa fa-expand"></i></a></div></div>';
                }
                $('.js-slick-data').html(html);

                if (result.data.price_sale != 0) {
                    $('.js-price-sale').text('SALE: ' + result.data.price_sale);
                } else {
                    $('.js-price-sale').text('');
                }
                $('.js-modal1').addClass('show-modal1');
            } else {
                alert('Có lỗi xảy ra');
            }
        },
        complete: function () {
            $('.wrap-slick3').each(function () {
                $(this).find('.slick3').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 6000,

                    arrows: true,
                    appendArrows: $(this).find('.wrap-slick3-arrows'),
                    prevArrow: '<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                    nextArrow: '<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

                    dots: true,
                    appendDots: $(this).find('.wrap-slick3-dots'),
                    dotsClass: 'slick3-dots',
                    customPaging: function (slick, index) {
                        var portrait = $(slick.$slides[index]).data('thumb');
                        return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
                    },
                });
            });
        }
    });
}

function loadmore() {
    const page = $('#page').val();
    $.ajax({
        type: 'GET',
        datatype: 'json',
        data: {
            page
        },
        url: '/loadmore',
        success: function (result) {
            // console.log(page);
            // console.log(result.html);
            if (result.html !== '') {
                $('#js-product-list').append(result.html);
                $('#page').val(parseInt(page) + 1);
            } else {
                alert('Không còn sản phẩm nào');
                $('#loadmore-btn').hide();
            }
        }
    });
}

function addToCart() {
    const id = $('#input_product_id').val();
    let quantity = $('.num-product').val();
    console.log(quantity);
    $.ajax({
        type: 'POST',
        datatype: 'json',
        data: {
            "_token": $('#token').val(),
            id,
            quantity
        },
        url: '/addToCart',
        success: function (result) {
            console.log(result);
            $('.cartProductQuantity').attr('data-notify', result.quantity);
            $(".header-cart-content").load(location.href + " .header-cart-content>*", "");
        }
    });
}

// Create our number formatter.
var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'VND',

    // These options are needed to round to whole numbers if that's what you want.
    //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
    //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

function changeQuantity(id, price, status) {
    let quantity = $('#quantity_product_' + id).val();

    if (status == 'up') {
        quantity = parseInt(quantity) + 1;
    } else if (status == 'down' && quantity >= 1) {
        quantity -= 1;
    }
    if (quantity == 0) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
            $('#table_row_' + id).remove();
            quantity = 0;
        } else {
            $('#quantity_product_' + id).val(parseInt(1));
            quantity = 1;
        }
    }

    let total = price * quantity;

    total = formatter.format(total); /* $2,500.00 */

    $('#total_product_price_' + id).text(total);

    $.ajax({
        type: 'GET',
        datatype: 'json',
        data: {
            id,
            quantity,
        },
        url: '/updateCart',
        success: function (result) {
            console.log(result);
            //$('.table-shopping-cart').load(location.href + ' .table-shopping-cart');
            result.total = formatter.format(result.total);
            $('.total').text(result.total);
            $('.cartProductQuantity').attr('data-notify', result.quantity);
            $(".header-cart-content").load(location.href + " .header-cart-content>*", "");
        }
    });
}

function removeProduct(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
        $.ajax({
            type: 'GET',
            datatype: 'json',
            data: {
                id,
            },
            url: '/removeProduct',
            success: function (result) {
                console.log(result);
                $('#table_row_' + id).remove();
                result.total = formatter.format(result.total);
                $('.total').text(result.total);
                $('.cartProductQuantity').attr('data-notify', result.quantity);
                $(".header-cart-content").load(location.href + " .header-cart-content>*", "");
            }
        });
    }
}

$('#payment_method').change(function () {
    let value = $(this).find("option:selected").attr("value");

    switch (value) {
        case "credit_card":
            $('#credit_card').removeClass('hidden');
            $('#atm_card').addClass('hidden');
            break;

        case "atm_card":
            $('#atm_card').removeClass('hidden');
            $('#credit_card').addClass('hidden');
            break;

        case "cod":
            $('#atm_card').addClass('hidden');
            $('#credit_card').addClass('hidden');
            break;
    }
});
