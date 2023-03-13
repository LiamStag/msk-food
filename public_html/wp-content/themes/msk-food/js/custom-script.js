jQuery(document).ready(function ($) {

    var scrolling = $('.scrolling'),
        scrollPrev = 0;

    $(window).scroll(function () {
        var scrolled = $(window).scrollTop();
        if (scrolled > 100 && scrolled > scrollPrev) {
            scrolling.addClass('out');
        } else if (scrolled == 0 || scrolled < (scrollPrev)) {
            scrolling.removeClass('out');
        }
        scrollPrev = scrolled;

    });

    $('.banner__home').imagesLoaded(function () {
        $('.banner__home').removeClass('d-none');
        $('.banner__home').slick({
            arrows: true,
            dots: true,
            fade: true,
            infinite: true,
        });
    });

    $('.gallery-slider').imagesLoaded(function () {
        $('.gallery-slider').removeClass('d-none');
        $('.gallery-slider').slick({
            arrows: true,
            dots: true,
            fade: true,
            infinite: true,

        });
        $('.home-product__slider').removeClass('d-none');

        $('.home-product__slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            fade: false,
            arrows: true,
            dots: false,
            lazyLoad: 'ondemand',
            responsive: [{

                breakpoint: 1440,
                settings: {
                    slidesToShow: 3,
                }

            }, {

                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                }

            }, {

                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    dots: false
                }

            }, {

            }],

        });
    });

    $('.product__slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        // fade: true,
        asNavFor: '.product__slider-nav'
    });
    $('.product__slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.product__slider-for',
        infinite: true,

        vertical: true,
        verticalSwiping: true,
        focusOnSelect: true
    });

    $('.home__cat-list--togle').click(function () {
        $('.home__cat:nth-child(n+5)').slideToggle('slow', 'swing');

    });


    var btntotop = $('.button__to-top');

    btntotop.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, '300');
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btntotop.addClass('show');
        } else {
            btntotop.removeClass('show');
        }
    });

    function hideRightCart(data) {

        var result = data.fragments[".basket-btn__counter"];
        $allquntity = +$(result).text().replace(/[^0-9.]/g, "");
        if ($allquntity == 0) {
            $('.rightcart').css('right', '-500px');
            $('body').css('overflow', '');
        }
    }

    function showRightCart() {

        $('.rightcart').animate({
            'right': '0px'
        }, {
            duration: 200,
            complete: function () {

                $height = String($(window).outerHeight() - $('.rightcart__header').outerHeight() - $('.rightcart__footer').outerHeight()) + 'px';
                $('.rightcart__body').css('max-height', $height);


                if ($('ul.rightcart__ul').outerHeight() > $('.rightcart__body').outerHeight()) {

                    $('.rightcart__body').animate({ scrollTop: $('.rightcart__body')[0].scrollHeight }, 4500);
                }
            }
        });

        $('.cart-preloader').fadeOut(1000, function () {
            $(this).remove();
        });;

        $('body').css('overflow', 'hidden');

    }

    function htmlDataFragments(data, frag) {


        if (!frag) {
            $('span.basket-btn__counter').html(data.fragments[".basket-btn__counter"]);
            $('.header__mini-cart').html(data.fragments["div.widget_shopping_cart_content"]);
            $('span.basket-btn__counter').html(data.fragments[".basket-btn__counter"]);
            $('.woocommerce-mini-cart__total').html(data.fragments["p.woocommerce-mini-cart__total"]);
            var str = $(data.fragments[".rightcart"]).html();

            $('.rightcart').html(str);

        } else {
            for (var i = 0; i < frag.length; i++) {

                if (frag[i] == 'data.fragments[".basket-btn__counter"]') {
                    $('span.basket-btn__counter').html(data.fragments[".basket-btn__counter"]);

                }

                if (frag[i] == 'data.fragments["div.widget_shopping_cart_content"]') {
                    $('.header__mini-cart').html(data.fragments["div.widget_shopping_cart_content"]);

                }

                if (frag[i] == 'data.fragments["div.header__mini-cart"]') {
                    $('span.basket-btn__counter').html(data.fragments["div.header__mini-cart"]);

                }

                if (frag[i] == 'data.fragments["p.woocommerce-mini-cart__total"]') {
                    $('.woocommerce-mini-cart__total').html(data.fragments["p.woocommerce-mini-cart__total"]);

                }

                if (frag[i] == 'data.fragments[".rightcart"]') {
                    var str = $(data.fragments[".rightcart"]).html();

                    $('.rightcart').html(str);

                }
            }

        }
    }

    $('.header__catalog').on('click', function () {
        $('.list-category__left').animate({
            'left': '0px'
        }, {
            duration: 200,

        });
        $('body').css('overflow', 'hidden');
    });

    $(document).mouseup(function (e) {
        var div = $('.list-category__left');
        var close = $('.list-category__left--close');
        if (!div.is(e.target) && div.has(e.target).length === 0 || close.is(e.target)) {
            $('.list-category__left').css('left', '-500px');
            $('body').css('overflow', '');
        }
    });

    $('.single_add_to_cart_button').on('click', function (e) {

        // || $(this).parent().hasClass('variations_button')
        if (this.classList.contains('disabled')) {
            return;
        }

        e.preventDefault();


        $thisbutton = $(this);

        $form = $thisbutton.closest('form.cart');

        id = $thisbutton.val();
        product_qty = $form.find('input[name=quantity]').val() || 1,
            product_id = $form.find('input[name=product_id]').val() || id,
            variation_id = $form.find('input[name=variation_id]').val() || 0;
        var data = {
            action: 'ql_woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
        };
        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {

                $thisbutton.removeClass('added').addClass('loading');

            },
            complete: function (response) {
                $thisbutton.addClass('added').removeClass('loading');

            },
            success: function (response) {

                if (response.error & response.product_url) {
                    alert(response.error);
                }

                $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);

            },
        });


    });

    $(".qtyval").bind('change keyup mouseup paste', function () {

        var qty = $(this).val();
        var key = $(this).attr("key");

        var product_price = $(this).attr("product_price");


        $('.quantity' + key).html(qty);

        if (qty == 0) {

            $('#' + key).hide();

        }
        var tot = product_price * qty;
        $('#' + key + ' .priceintable').html('<span class="woocommerce-Price-currencySymbol">$</span> ' + parseFloat(tot).toFixed(2));



        // if (ajaxRequest) { // if any previous ajaxRequest is running, abort
        //     ajaxRequest.abort();
        // }

        var ajaxRequest = jQuery.ajax({
            type: "POST",
            url: front.ajaxurl,
            data: {
                action: 'my_first_ajax',

                qty: qty,
                key: key
            },
            success: function (data) {

                var frag = ['data.fragments[".basket-btn__counter"]', 'data.fragments["div.widget_shopping_cart_content"]', 'data.fragments["p.woocommerce-mini-cart__total"]'];

                htmlDataFragments(data, frag);

                hideRightCart(data);

            }
        });

    });

    $('[data-fancybox="images"]').fancybox({
        buttons: [
            "zoom",
            //"share",
            "slideShow",
            //"fullScreen",
            //"download",
            "thumbs",
            "close"
        ],
    });

    if (document.getElementsByClassName('page-template-page-cart-page')) {
        $(document).on('click', '.plus, .minus', function () {

            setTimeout(function () {
                $('[name="update_cart"]').trigger('click');
            }, 1000);

        });
    }

    $('body').on('added_to_cart', function () {
        showRightCart();
    });

    $('body').on("click", 'a.remove_from_cart_but', function (e) {
        var itemDel = $(this).parent();


        var product_id = $(this).attr("data-product_id");
        var cart_item_key = $(this).attr("data-cart_item_key");
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: front.ajaxurl,
            data: {
                action: "product_remove",
                product_id: product_id,
                key: cart_item_key,
            },
            success: function (data) {



                $(itemDel).slideUp('slow', function () {
                    $(this).remove();
                });


                hideRightCart(data);

                var frag = ['data.fragments[".basket-btn__counter"]', 'data.fragments["div.widget_shopping_cart_content"]', 'data.fragments["p.woocommerce-mini-cart__total"]'];

                htmlDataFragments(data, frag);
            }
        });
        return false;

    });



    function closeRightCart() {
        $(document).mouseup(function (e) {
            var div = $('.rightcart');
            var close = $('.rightcart__header--close');
            if (!div.is(e.target) && div.has(e.target).length === 0 || close.is(e.target)) {
                $('.rightcart').css('right', '-500px');
                $('body').css('overflow', '');
            }
        });
    };

    closeRightCart();





    $('body').on("change keyup mouseup paste", '.qtyval', function () {

        var qty = $(this).val();
        var key = $(this).attr("key");

        var product_price = jQuery(this).attr("product_price");

        $('.quantity' + key).html(qty);

        if (qty == 0) {

            $('#' + key).slideUp('slow', function () {
                $(this).remove();
            });


        }

        var tot = product_price * qty;
        $('#' + key + ' .priceintable').html(parseFloat(tot).toFixed(2) + ' <span class="woocommerce-Price-currencySymbol">₽</span>');

        if (ajaxRequest) { // if any previous ajaxRequest is running, abort
            ajaxRequest.abort();
        }


        var ajaxRequest = jQuery.ajax({
            type: "POST",
            url: front.ajaxurl,
            data: {
                action: 'my_first_ajax',

                qty: qty,
                key: key
            },
            success: function (data) {

                var frag = ['data.fragments[".basket-btn__counter"]', 'data.fragments["div.widget_shopping_cart_content"]', 'data.fragments["p.woocommerce-mini-cart__total"]'];

                htmlDataFragments(data, frag);

                hideRightCart(data);

            }
        });


    });




    $('body').on("click", '.ddd', function () {

        var $button = jQuery(this);

        var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();


        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {

            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }

        $button.closest('.sp-quantity').find("input.quntity-input").val(newVal);
        $button.closest('.sp-quantity').find("input.quntity-input").change();

    });



});

document.addEventListener("DOMContentLoaded", function (event) {

    const listToggle = document.querySelector('.home__cat-list--togle');

    if (!listToggle) {
        return;
    }

    listToggle.addEventListener('click', changeText, false);

    function changeText() {

        const p = listToggle.firstElementChild;

        if (p.style.marginTop == '-41px') {
            p.style.cssText = 'margin-top: 0px;';
        } else {
            p.style.cssText = 'margin-top: -41px;';
        }
    };

});

function addCartPreloader() {
    const addCarts = document.querySelectorAll('.add_to_cart_button');

    if (!addCarts) {
        return;
    }

    for (let i = 0; i < addCarts.length; i++) {
        addCarts[i].addEventListener('click', cartLoader, false);

    }

    function cartLoader() {


        if (this.classList.contains('product_type_variable')) {
            return;
        }

        const loader = this.closest('.home-product__slide');

        const preloader = document.createElement('div');
        preloader.className = 'cart-preloader';
        preloader.innerHTML = ' <div class="circle circle4 circle1-4"><div class="circle circle4 circle2-4"><div class="circle circle4 circle3-4"></div></div</div>';

        loader.appendChild(preloader);

    };


};

document.addEventListener("DOMContentLoaded", addCartPreloader);



window.onload = function maskedInput() {

    function setCursorPosition(pos, elem) {
        elem.focus();
        if (elem.setSelectionRange) elem.setSelectionRange(pos, pos);
        else if (elem.createTextRange) {
            var range = elem.createTextRange();
            range.collapse(true);
            range.moveEnd("character", pos);
            range.moveStart("character", pos);
            range.select()
        }
    }

    function mask(event) {
        var matrix = "+7 (___) ___-__-__",
            i = 0,
            def = matrix.replace(/\D/g, ""),
            val = this.value.replace(/\D/g, "");
        if (def.length >= val.length) val = def;
        this.value = matrix.replace(/./g, function (a) {
            return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
        });
        if (event.type == "blur") {
            if (this.value.length == 2) this.value = ""
        } else setCursorPosition(this.value.length, this)
    };
    var input = document.querySelector("#billing_phone");
    if (input) {
        input.addEventListener("input", mask, false);
        input.addEventListener("focus", mask, false);
        input.addEventListener("blur", mask, false);
    }

}



jQuery(function ($) {
    if (!String.prototype.getDecimals) {
        String.prototype.getDecimals = function () {
            var num = this,
                match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            if (!match) {
                return 0;
            }
            return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
        }
    }
    // Quantity "plus" and "minus" buttons
    $(document).on('click', '.plus, .minus', function () {
        var $qty = $(this).closest('.quantity').find('.qty'),
            currentVal = parseFloat($qty.val()),
            max = parseFloat($qty.attr('max')),
            min = parseFloat($qty.attr('min')),
            step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        // Change the value
        if ($(this).is('.plus')) {
            if (max && (currentVal >= max)) {
                $qty.val(max);
            } else {
                $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
            }
        } else {
            if (min && (currentVal <= min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
            }
        }

        // Trigger change event
        $qty.trigger('change');
    });
});
