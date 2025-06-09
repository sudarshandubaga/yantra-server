const baseUrl = $('base').attr('href') + '/';

$(function() {
    $.fn.showLoading = (function() {
        if (!$('.loading-box').length) {
            let loadingHtml = `
                <div class="loading-box">
                    <div class="loading-bg"></div>
                    <div class="loading-body">
                        <div class="form-group">
                            <img src="${baseUrl}imgs/loader-2_food.gif" alt="">
                        </div>
                        <div>
                            Loading, please wait...
                        </div>
                    </div>
                </div>
            `;
            $('body').append(loadingHtml);
        }
    });
    $.fn.hideLoading = (function() {
        setTimeout(function() {
            $('.loading-box').remove();
        }, 300);
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $('#select_all').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            alert('43633');
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    $(document).on('click', '#changeselectStatus', function() {
        ajax_url = $(this).data('url');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            success: function(res) {
                $('#cartFooter').html(res.cart_footer);
                $(document).hideLoading();
            }
        });

    });

    // Send Contact Enquiry
    $(document).on('submit', '[name="contact-form"]', function(e) {
        e.preventDefault();

        let form = $(this),
            submit_btn = form.find('[type=submit]'),
            ajax_url = form.attr('action'),
            is_valid = form.is_valid();

        form.find('.form-msg').removeClass('alert alert-info alert-success alert-danger').html('');

        if (is_valid) {
            submit_btn.attr('disabled', 'disabled').html('Please wait...');
            form.find('.form-msg').addClass('alert alert-info').html("Please wait, progressing...");
            $.ajax({
                url: ajax_url,
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    submit_btn.removeAttr('disabled').html('SEND MESSAGE');
                    form.find('.form-msg').removeClass('alert-info').addClass('alert-success').html(response.message);

                    form.find('input, textarea').val('');
                },
                error: function(err) {
                    console.log(err);
                    form.find('.form-msg').removeClass('alert-info').addClass('alert-danger').html('Some error occurs, mail not sent.');
                }
            });
        }
    });

    $(document).on('click', '.select_addressR', function() {

        $('.mycheckbox').removeClass('selected-radiobtn');
        $(this).closest('.mycheckbox').addClass('selected-radiobtn');

    });

    $(document).on('click', '.select_addressA', function() {

        $('.mycheckboxA').removeClass('selected-radiobtn');
        $(this).closest('.mycheckboxA').addClass('selected-radiobtn');

    });

    // Apply Coupon
    $(document).on('click', '.apply_coupon', function() {
        let coupon_code = $('#coupon_code').val(),
            ajax_url = $(this).data('url');

        if (coupon_code == '') {
            $('#coupon_code').focus();
            $('#coupon_code').css({ 'border-color': 'red' });
        } else {
            $('#coupon_code').css({ 'border-color': '' });
            $(document).showLoading();
            $.ajax({
                url: ajax_url,
                type: 'POST',
                data: {
                    coupon_code: coupon_code
                },
                success: function(res) {
                    $(document).hideLoading();
                    if (res.status == false) {
                        CMessage = `<div class="mt-3" id="couponmassege" style="color:red;">${res.message}</div>`;
                    } else {
                        CMessage = `<div class="mt-3" id="couponmassege" style="color:green;">${res.message}</div>`;
                    }
                    $('#massege').closest("span").append(CMessage);
                    $('#cartFooter').html(res.cart_footer);
                    setTimeout(function() {
                        $('#couponmassege').remove();
                    }, 5000);
                }
            });
        }
    });

    $(document).on('click', '.remove-coupan', function() {
        ajax_url = $(this).data('url');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            success: function(res) {
                $('#cartFooter').html(res.cart_footer);
                $(document).hideLoading();
            }
        });

    });


    $(document).on('click', '.price-textbox .plus-text', function() {
        let inp = $(this).closest('.price-textbox').find('input'),
            qty = parseInt(inp.val());

        inp.val(qty + 1);
    });

    $(document).on('click', '.price-textbox .minus-text', function() {
        let inp = $(this).closest('.price-textbox').find('input'),
            qty = parseInt(inp.val());

        if (qty > 1) {
            inp.val(qty - 1);
        }
    });

    $(document).on('click', '.updateCartBtn', function() {
        let form = $(this).closest('form'),
            ajax_url = form.attr('action');

        $(document).showLoading();
        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: form.serialize(),
            success: function(res) {
                $(document).hideLoading();
                $('.shop-cart.header-collect').html(res.header_cart);
                $('#cartResponse').html(res.cart_table);
                $('#cartFooter').html(res.cart_footer);
            }
        });
    });

    $(document).on('click', '.updateCart_resvBtn', function() {
        let form = $(this).closest('form'),
            ajax_url = form.attr('action');

        $(document).showLoading();
        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: form.serialize(),
            success: function(res) {
                $(document).hideLoading();
                $('#bookingCartResponse').html(res.cart_html);
            }
        });
    });

    $(document).on('click', '.send_otp_btn', function() {

        let mobile = $($(this).data('target'));

        mob = /^[0-9]{10}$/;

        mobile.closest("div").find(".invalid-feedback").remove();
        mobile.closest("div").find(".is-invalid").removeClass("is-invalid");
        mobile.closest("div").find("div").removeClass("has-danger");

        if (mobile.val() != '' && mob.test(mobile.val())) {

            $(document).showLoading();
            $.ajax({
                url: baseUrl + "ajax/send-otp",
                type: 'POST',
                data: {
                    mobile: mobile.val()
                },
                success: function(res) {
                    $(document).hideLoading();
                    mobile.addClass("is-valid");
                    mobile.closest("div").append('<div class="valid-feedback">OTP has been sent.</div>');
                }
            });
        } else if (mobile.val() == '') {
            mobile.addClass("is-invalid");
            mobile.closest("div").append('<div class="invalid-feedback">Please enter mobile no.</div>');
        } else {
            mobile.addClass("is-invalid");
            mobile.closest("div").append('<div class="invalid-feedback">Please enter only 10 digit numeric value.</div>');
        }
    });

    $(document).on('click', '.shop-cart-close, .cart-remove-icon', function() {
        let ajax_url = $(this).data('url'),
            pid = $(this).data('pid');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid,
                qty: 1
            },
            success: function(res) {
                $(document).hideLoading();
                $('.shop-cart.header-collect').html(res.header_cart);
                if ($('#cartResponse').length > 0) {
                    $('#cartResponse').html(res.cart_table);
                }
                if ($('#cartFooter').length > 0) {
                    $('#cartFooter').html(res.cart_footer);
                }
            }
        });
    });

    $(document).on('click', '.shop-cart_resv-close, .cart_resv-remove-icon', function() {
        let ajax_url = $(this).data('url'),
            pid = $(this).data('pid');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid,
                qty: 1
            },
            success: function(res) {
                $(document).hideLoading();
                $('#bookingCartResponse').html(res.cart_html);
            }
        });
    });

    // Rate N Reviews
    $(document).on('click', '.rate_menu_btn', function() {
        let id = $(this).data('id');
        $('#review_pid').val(id);
        $('#reviewModal').modal('show');
    });

    $(document).on("submit", "#productRatingForm", function(e) {
        e.preventDefault();

        let form = $(this),
            ajax_url = form.attr('action'),
            formData = form.serialize();

        let is_valid = form.is_valid();

        if (is_valid) {
            $('#reviewModal').modal('hide');
            $(document).showLoading();
            $.ajax({
                url: ajax_url,
                type: 'POST',
                data: formData,
                success: function(res) {
                    $(document).hideLoading();
                    location.reload();
                }
            });
        }
    });

    $(window).on("load", function() {
        // $('.portfolioFilter .current , .galleryportfolio .current').removeClass('current');
        // $(this).addClass('current');
        var selector = $('.portfolioFilter .current , .galleryportfolio .current').attr('data-filter');
        var $container = $('.portfolioContainer , .gallery-filter');
        $container.isotope({
            layoutMode: 'masonry',
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false,
            }
        });
    });

    $(document).on('keyup change', '#fname, #lname', function() {
        let name = ($('#fname').val() + ' ' + $('#lname').val()).trim();

        $('#name').val(name);
    });
    $(document).on('click', '.addToCartBtnSingle', function() {
        let ajax_url = $(this).data('url'),
            qty = $('.price-textbox').find('input').val(),
            pid = $(this).data('pid');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid,
                qty: qty
            },
            success: function(res) {
                $(document).hideLoading();
                $('.shop-cart.header-collect').html(res.header_cart);

                let cartMessage = `
                    <div class="alert alert-success">${res.message}</div>
                `;
                $('#cartMessage').html(cartMessage);
                setTimeout(function() {
                    $('#cartMessage').html('');
                }, 5000);
            }
        });
    });

    $(document).on('click', '.addToCart_resvBtnSingle', function() {
        let ajax_url = $(this).data('url'),
            qty = $('.price-textbox').find('input').val(),
            pid = $(this).data('pid');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid,
                qty: qty
            },
            success: function(res) {
                $(document).hideLoading();
                $('#bookingCartResponse').html(res.cart_html);

                let cartMessage = `
                    <div class="alert alert-success">${res.message}</div>
                `;
                $('#cartMessage').html(cartMessage);
                setTimeout(function() {
                    $('#cartMessage').html('');
                }, 5000);
            }
        });
    });

    $(document).on('click', '.addToCartBtnSinglewithshow', function() {
        let ajax_url = $(this).data('url'),
            qty = $('.price-textbox').find('input').val(),
            pid = $(this).data('pid');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid,
                qty: qty
            },
            success: function(res) {
                $(document).hideLoading();
                $('.shop-cart.header-collect').html(res.header_cart);

                let cartMessage = `
                    <div class="alert alert-success">${res.message}</div>
                `;
                $('#cartMessage').html(cartMessage);
                setTimeout(function() {
                    $('#cartMessage').html('');
                }, 5000);

                window.location = baseUrl + 'cart';
            }
        });
    });

    $(document).on('click', '.addToCart_resvBtnSinglewithshow', function() {
        let ajax_url = $(this).data('url'),
            qty = $('.price-textbox').find('input').val(),
            pid = $(this).data('pid');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid,
                qty: qty
            },
            success: function(res) {
                $(document).hideLoading();
                $('#bookingCartResponse').html(res.cart_html);

                let cartMessage = `
                    <div class="alert alert-success">${res.message}</div>
                `;
                $('#cartMessage').html(cartMessage);
                setTimeout(function() {
                    $('#cartMessage').html('');
                }, 5000);

                window.location = baseUrl + 'cart_resv';
            }
        });
    });


    $(document).on('click', '.addToCartBtn', function() {
        let ajax_url = $(this).data('url'),
            pid = $(this).data('pid');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid,
                qty: 1
            },
            success: function(res) {
                $(document).hideLoading();
                $('.shop-cart.header-collect').html(res.header_cart);

                let cartMessage = `
                    <div class="alert alert-success">${res.message}</div>
                `;

                $('#cartMessage').html(cartMessage);
                setTimeout(function() {
                    $('#cartMessage').html('');
                }, 5000);
            }
        });
    });

    $(document).on('click', '.addToCart_resvBtn', function() {
        let ajax_url = $(this).data('url'),
            pid = $(this).data('pid');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid,
                qty: 1
            },
            success: function(res) {
                $(document).hideLoading();
                // $('.shop-cart.header-collect').html( res.header_cart_resv );
                $('#bookingCartResponse').html(res.cart_html);

                let cartMessage = `
                    <div class="alert alert-success">${res.message}</div>
                `;

                $('#cartMessage').html(cartMessage);
                setTimeout(function() {
                    $('#cartMessage').html('');
                }, 5000);
            }
        });
    });


    $(document).on('click', '.addToCartBtnwithshow', function() {
        let ajax_url = $(this).data('url'),
            pid = $(this).data('pid');

        $(document).showLoading();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid,
                qty: 1
            },
            success: function(res) {
                $(document).hideLoading();
                $('.shop-cart.header-collect').html(res.header_cart);

                let cartMessage = `
                    <div class="alert alert-success">${res.message}</div>
                `;

                $('#cartMessage').html(cartMessage);
                setTimeout(function() {
                    $('#cartMessage').html('');
                }, 5000);
                // return redirect(route('cart'));
                window.location = baseUrl + 'cart';
            }
        });
    });

    /*
     * ====================================================
     * WISHLIST
     * ====================================================
     **/

    $(document).on('click', '.addToWishlist', function() {
        let ajax_url = $(this).data('url'),
            pid = $(this).data('pid');

        // $(document).showLoading();

        $(this).toggleClass('fa-heart-o fa-heart');

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid
            },
            success: function(res) {

            }
        });
    });

    $(document).on('click', '.removeToWishlist', function() {
        let ajax_url = $(this).data('url'),
            pid = $(this).data('pid');

        $(document).showLoading();
        $(this).closest('.shop-main-list').attr('style', 'display:none');

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                pid: pid
            },
            success: function(res) {
                $(document).hideLoading();
            }
        });
    });

    /*
     * ===================================================
     * Blog Like Dislike
     * ====================================================
     */

    $(document).on('click', '.likedislike', function() {
        let ajax_url = $(this).data('url'),
            bid = $(this).data('bid');
        status = $(this).data('status');

        if (status == 'like') {
            $(this).addClass('fa-thumbs-up');
            $(this).removeClass('fa-thumbs-o-up');
            $(this).closest('.span1').find('#blogdislike').removeClass('fa-thumbs-down');
            $(this).closest('.span1').find('#blogdislike').addClass('fa-thumbs-o-down');

            var dislikevalue = $(this).closest('.span1').find('.blogdislikevalue').html();
            var likevalue = $(this).closest('.span1').find('.bloglikevalue').html();
            likevalue = parseInt(likevalue) + parseInt(1);
            dislikevalue = parseInt(dislikevalue) - parseInt(1);
            if (dislikevalue < 0) {
                dislikevalue = 0;
            }
            $(this).closest('.span1').find('.bloglikevalue').html(likevalue);
            $(this).closest('.span1').find('.blogdislikevalue').html(dislikevalue);
            $(this).closest('.span1').find('#bloglike').removeClass('likedislike');
            $(this).closest('.span1').find('#blogdislike').addClass('likedislike');
        } else {
            $(this).addClass('fa-thumbs-down');
            $(this).removeClass('fa-thumbs-o-down');
            $(this).closest('.span1').find('#bloglike').removeClass('fa-thumbs-up');
            $(this).closest('.span1').find('#bloglike').addClass('fa-thumbs-o-up');
            var dislikevalue = $(this).closest('.span1').find('.blogdislikevalue').html();
            var likevalue = $(this).closest('.span1').find('.bloglikevalue').html();
            likevalue = parseInt(likevalue) - parseInt(1);
            dislikevalue = parseInt(dislikevalue) + parseInt(1);
            if (likevalue < 0) {
                likevalue = 0;
            }
            $(this).closest('.span1').find('.bloglikevalue').html(likevalue);
            $(this).closest('.span1').find('.blogdislikevalue').html(dislikevalue);
            $(this).closest('.span1').find('#blogdislike').removeClass('likedislike');
            $(this).closest('.span1').find('#bloglike').addClass('likedislike');
        }

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                bid: bid,
                status: status
            },
            success: function(res) {

            }
        });
    });


    /*
     * ====================================================
     * CHECKOUT SCRIPTS
     * ====================================================
     **/
    $(document).on('click change', '#shipDifferentAddress', function() {
        if ($(this).prop('checked')) {
            $('#shippingAddress').removeClass('hidden');
            $('.require').attr('required', 'required');
        } else {
            $('#shippingAddress').addClass('hidden');
            $('.require').removeAttr('required');
        }
    });
    $(document).on('click change', '#shipDifferentAddress1', function() {
        if ($(this).prop('checked')) {
            $('#shippingAddress1').removeClass('hidden');
            $('.require').attr('required', 'required');
        } else {
            $('#shippingAddress1').addClass('hidden');
            $('.require').removeAttr('required');
        }
    });
    $(document).on('click change', '[name="create_account"]', function() {
        if ($(this).prop('checked')) {
            $('#customerPassword').removeClass('hidden');
            $('[name="password"]').attr('required', 'required');
        } else {
            $('#customerPassword').addClass('hidden');
            $('[name="password"]').removeAttr('required');
        }
    });

    $(document).on('click', '.subscribe-btn', function(e) {
        let ajax_url = $(this).data('url');
        e.preventDefault();
        var email = $('#subs_email').val();
        email = email.toLowerCase();

        var reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/;
        if (email == '') {
            $('#subs_email').focus();
        } else if (!reg.test(email)) {
            $('#subs_email').focus();
        } else {
            $.ajax({
                url: ajax_url,
                type: 'POST',
                data: $('form.welcome_popup').serialize(),
                success: function(res) {

                    window.location = baseUrl;
                }
            });
        }
    });

    $(document).on('submit', '#user_login', function(e) {
        let ajax_url = $(this).attr('action');
        e.preventDefault();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: $('form.user_login').serialize(),
            success: function(res) {

                if (res.success == 1) {
                    location.reload();
                } else if (res.success == 2) {
                    toggleModel('#userVerifyotpModel');
                } else if (res.success == 3) {
                    $("form").before("<div>" + res.message + "</div>");
                    toggleModel('#userRegisterModel');
                } else {
                    $("#user_password").focus();
                    $("#user_password").css({ 'border-color': 'red' });
                }

            }
        });

    });

    $(document).on('submit', '#registerForm', function(e) {

        let ajax_url = $(this).attr('action');

        e.preventDefault();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: $('form.user_register').serialize(),
            success: function(res) {
                if (res.success == 1) {
                    toggleModel('#userVerifyotpModel');
                } else if (res.success == 2) {
                    $("form").before("<div>" + res.message + "</div>");
                    $("#user_referalcode").focus();
                    $("#user_referalcode").css({ 'border-color': 'red' });
                    toggleModel('#userRegisterModel');
                } else {
                    $("form").before("<div>" + res.message + "</div>");
                    toggleModel('#userLoginModel');
                }

            }
        });

    });

    $(document).on('submit', '#user_verifyotp', function(e) {

        let ajax_url = $(this).attr('action');

        e.preventDefault();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: $('form.user_verifyotp').serialize(),
            success: function(res) {

                if (res.success) {
                    $("form").before("<div>" + res.message + "</div>");
                    toggleModel('#userLoginModel');
                } else {
                    $(".otp-match").focus();
                    $(".otp-match").css({ 'border-color': 'red' });
                }

            }
        });

    });

    $(document).on('submit', '#user_forgotpass', function(e) {

        let ajax_url = $(this).attr('action');

        e.preventDefault();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: $('form.user_forgotpass').serialize(),
            success: function(res) {

                if (res.success) {
                    toggleModel('#userVerifyotpforgotModel');
                } else {
                    $(".mobile-match").focus();
                    $(".mobile-match").css({ 'border-color': 'red' });
                }

            }
        });

    });

    $(document).on('submit', '#user_verifyforgototp', function(e) {

        let ajax_url = $(this).attr('action');

        e.preventDefault();

        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: $('form.user_verifyforgototp').serialize(),
            success: function(res) {

                if (res.success) {
                    toggleModel('#userRecoverpassModel');
                } else {
                    $(".otp-match").focus();
                    $(".otp-match").css({ 'border-color': 'red' });
                }

            }
        });

    });

    $(document).on('submit', '#user_recoverpass', function(e) {

        let ajax_url = $(this).attr('action');
        e.preventDefault();

        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();

        if (new_password == '') {
            $('#new_password').focus();
            $('#new_password').css({ 'border-color': 'red' });
        } else if (new_password.length < 8) {
            $("#new_password_msg").html("");
            $("#new_password_msg").html("Password at list 8 characters.");
            $('#new_password').focus();
            $('#new_password').css({ 'border-color': 'red' });

        } else if (new_password !== confirm_password) {
            $('#confirm_password').focus();
            $('#confirm_password').css({ 'border-color': 'red' });
        } else {

            $.ajax({
                url: ajax_url,
                type: 'POST',
                data: $('form.user_recoverpass').serialize(),
                success: function(res) {

                    if (res.success) {
                        $("form").before("<div>" + res.message + "</div>");
                        toggleModel('#userLoginModel');
                    } else {
                        $(".pass-match").focus();
                        $(".pass-match").css({ 'border-color': 'red' });
                    }

                }
            });
        }

    });

    $(document).on('click', '#menuSlidercart', function() {
        $("#slider_details").modal('hide');
    });

    $(document).on('click', '#login_resendotp', function() {

        $.ajax({
            url: baseUrl + "resend-otp",
            type: 'POST',
            success: function(res) {

            }
        });

    });

    $(document).on('submit', '#reservationForm', function(e) {

        let ajax_url = $(this).attr('action');

        e.preventDefault();
        $(document).showLoading();
        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: $('form.reservation_table').serialize(),
            success: function(res) {
                if (res.success == 1) {
                    if ($('#radio_1')[0].checked) {
                        $(document).hideLoading();
                        window.location = baseUrl + 'menu_resv';
                    } else {
                        $(document).hideLoading();
                        $("#booktable").modal('hide');
                        $("#booktable_success").modal('show');
                    }
                } else {
                    $(document).hideLoading();
                    $("#otp_msg").html(res.message);
                }
            }
        });

    });



});

function user_login() {
    $("#user_login").modal('show');
}

function order_track() {
    $("#orderTrack").modal('show');
}


function slider_details($mid) {
    $.ajax({
        url: baseUrl + "slider_details/" + $mid,
        type: 'POST',
        success: function(res) {
            // alert(res);
            $("#slider_details").modal('show');
            $('#menu_slider').html(res);
        }
    });
}

function toggleModel(target) {
    $(target).addClass('active');
    $('.auth-model').not(target).removeClass('active');
}



$(document).on('click', '#map-address', function() {
    $val = $('.mapview').attr('display');

    if ($val == 'none') {
        $(".mapview").css({ 'display': 'block' });
        $(".mapview").attr('display', 'block');
        // $('#body-overlay1').addClass('overlay-body');
        // $('#body-overlay2').addClass('overlay-body');
        // $('#body-overlay3').addClass('overlay-body');
    } else {
        $(".mapview").css({ 'display': 'none' });
        $(".mapview").attr('display', 'none');
        // $('#body-overlay1').removeClass('overlay-body');
        // $('#body-overlay2').removeClass('overlay-body');
        // $('#body-overlay3').removeClass('overlay-body');
    }
});

// Apply Point
$(document).on('click', '.apply_point', function() {

    ajax_url = $(this).data('url');
    $(document).showLoading();
    $.ajax({
        url: ajax_url,
        type: 'POST',
        success: function(res) {
            $(document).hideLoading();
            if (res.status == false) {
                CMessage = `<div class="mt-3" id="couponmassege" style="color:red;">${res.message}</div>`;
            } else {
                CMessage = `<div class="mt-3" id="couponmassege" style="color:green;">${res.message}</div>`;
                $(this).attr('checked', 'checked');
            }
            $('#massege').closest("span").append(CMessage);
            $('#cartFooter').html(res.cart_footer);
            setTimeout(function() {
                $('#couponmassege').remove();
            }, 5000);
        }
    });
});

// Remove Point
$(document).on('click', '.remove_point', function() {
    ajax_url = $(this).data('url');
    $(document).showLoading();
    $.ajax({
        url: ajax_url,
        type: 'POST',
        success: function(res) {
            $(document).hideLoading();
            if (res.status == false) {
                CMessage = `<div class="mt-3" id="couponmassege" style="color:red;">${res.message}</div>`;
            } else {
                CMessage = `<div class="mt-3" id="couponmassege" style="color:green;">${res.message}</div>`;
                $(this).attr('checked', 'checked');
            }
            $('#massege').closest("span").append(CMessage);
            $('#cartFooter').html(res.cart_footer);
            setTimeout(function() {
                $('#couponmassege').remove();
            }, 5000);
        }
    });
});

$(document).on('submit', '#mapaddressForm', function(e) {
    let ajax_url = $(this).attr('action');
    e.preventDefault();
    $(document).showLoading();
    $.ajax({
        url: ajax_url,
        type: 'POST',
        data: $('form.mapaddress_form').serialize(),
        success: function(res) {
            $(document).hideLoading();
            location.reload();
        }
    });
});