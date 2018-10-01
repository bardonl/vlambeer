
winkelWagen = {

    url: 'http://vlambeer.badge-webdevelopment.nl/app/controllers/shoppingCartControl.php',

    updateNumber: function () {
        $.ajax({
            type: 'POST',
            url: winkelWagen.url,
            data: {
                'shoppingCart': 'updateNum'
            },
            success: function (data) {
                if(data === 'remove') {
                    $('.cart-icon i').remove();
                } else {
                    $('.cart-icon').append(data);
                }
            }
        })
    },

    toggleCartPreview: function () {
        $('.shoppingcart').on("click", function () {
            $('#shop-cart-preview').slideToggle('fast');
            $('.user-menu').slideUp('fast');
        });

        $('.header').next('div').on("click", function () {
            $('#shop-cart-preview').slideUp('fast');
        });

        $('#shop-cart-preview').on("click", function (e) {
            e.stopPropagation();
        });
    },
    
    addToShoppingCart: function () {
        $.ajax({
            type: 'POST',
            url: winkelWagen.url,
            data: {
                'shoppingCart': 'add-product',
                'product_id': $('#productId').val(),
                'size': $('#size').val(),
                'quantity': 1
            },
            success: function(data) {
                if(data === 'error') {
                    $('.message-shop-cart').slideDown('fast');
                    $('.shop-cart-message-text').removeClass('alert-success');
                    $('.shop-cart-message-text').addClass('alert-danger');
                    $('.shop-cart-message-text').text('Please select a size');
                    setTimeout(function () {
                        $('.message-shop-cart').slideUp('fast');
                    }, 2000);
                    return false;
                } else {
                    winkelWagen.loadShoppingCart();
                    winkelWagen.updateNumber();
                    if($('.pl-container > div:nth-of-type(2)').is(':animated')) {
                        return false;
                    }

                    $('body').css({
                        'overflow-x': 'hidden'
                    });

                    $('.pl-container').css({
                        'position': 'relative'
                    });
                    $('.product-overview').clone().appendTo('.pl-container');
                    var clone = $('.pl-container > div:nth-of-type(2)');
                    clone.css({
                        'position': 'absolute',
                        'left': '50%',
                        'top': '50%',
                        'transform': 'translate(-50%,-50%)'
                    });
                    clone.animate({
                        'width': '1px',
                        'height': '1px',
                        'top': '-250px',
                        'left': '130%'
                    }, 450, 'swing');
                    clone.fadeOut('fast');
                    setTimeout(function () {
                        clone.remove();
                    }, 450);
                    
                    winkelWagen.updateShopCart();

                    $('.message-shop-cart').slideDown('fast');
                    $('.shop-cart-message-text').removeClass('alert-danger');
                    $('.shop-cart-message-text').addClass('alert-success');
                    $('.shop-cart-message-text').text('Product added to shopping cart');
                    setTimeout(function () {
                        $('.message-shop-cart').slideUp('fast');
                    }, 2000);
                }


            }
        })
    },
    
    updateShopCart: function() {
        $.ajax({
            type: 'POST',
            url: winkelWagen.url,
            data: {
                shoppingCart: 'updateCart'
            },
            success: function (data) {
                $('.shop-cart-preview-placer').nextUntil('.empty-shop-cart p').remove();
                $('.shop-cart-preview-placer').after(data);
            }
        })
    },

    deleteFromShopCart: function (product, shopCart, size) {
        $.ajax({
            type: 'POST',
            url: winkelWagen.url,
            data: {
                'shoppingCart': 'delete',
                'productId': product,
                'shopCartId': shopCart,
                'size': size
            },
            success: function (data) {
                console.log(data);
                winkelWagen.loadShoppingCart();
                winkelWagen.updateNumber();
            }
        })
    },

    loadShoppingCart: function () {
        $.ajax({
            url: winkelWagen.url,
            type: 'POST',
            data: {
                shoppingCart: 'updateShopCartInfo'
            },
            success: function (data) {
                $('.shop-cart-load').children().remove();
                $('.shop-cart-load').append(data);
            }
        })
    },
    
    updateQuantity: function (product, shopCart, size, quantity) {
        $.ajax({
            url: winkelWagen.url,
            type: 'POST',
            data: {
                'shoppingCart': 'edit',
                'productId': product,
                'shopCartId': shopCart,
                'size': size,
                'quantity': quantity
            },
            success: function (data) {
                console.log(data);
                winkelWagen.loadShoppingCart();
                winkelWagen.updateNumber();
            }
        })
    },

    unloadShoppingCart: function() {
        $.ajax({
            url: winkelWagen.url,
            type: 'POST',
            data: {
                'shoppingCart': 'unload'
            },
            success: function (data) {
                top.location.href= data;
            }
        })
    },

    changeOrderStatus: function (orderId, orderStatusVal) {
        $.ajax({
            url: winkelWagen.url,
            type: 'POST',
            data: {
                shoppingCart: 'changeOrderStatus',
                orderStatus: orderStatusVal,
                orderId: orderId
            },

            success: function (data) {
                console.log(data);
            }
        })
    }
};

winkelWagen.toggleCartPreview();
winkelWagen.updateNumber();

$('#inShoppingCart').on("click", function () {
    winkelWagen.addToShoppingCart();
});


$('.shoppingcart').on("click", function () {
    winkelWagen.loadShoppingCart();
    winkelWagen.updateShopCart();
    winkelWagen.updateNumber();
});


    $('body').on("click", '.remove-product-from-cart', function () {
        let navigate = $(this).closest('.shop-cart-product-list').find('.cartIds');
        winkelWagen.deleteFromShopCart(
            navigate.find('.product-id-shop-cart').val(),
            navigate.find('.shop-cart-active-id').val(),
            navigate.find('.product-size').val()
        );
    });

    $('body').on("change", '.quantity-cart', function () {
        let navigate = $(this).closest('.shop-cart-product-list').find('.cartIds');
        winkelWagen.updateQuantity(
            navigate.find('.product-id-shop-cart').val(),
            navigate.find('.shop-cart-active-id').val(),
            navigate.find('.product-size').val(),
            $(this).val() );
        });


$('#unload-shop-cart').on("click", function (e) {
    e.preventDefault();
    winkelWagen.unloadShoppingCart();
});


$('.edit-order-status').on("change", function () {
    let orderId = $(this).next().val();
    var orderStatusVal = $(this).find('option:selected').val();
    winkelWagen.changeOrderStatus(orderId, orderStatusVal);
});




