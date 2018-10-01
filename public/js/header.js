$(document).ready(function () {
    var header = {
        toggleMenu: function (btn) {
            btn.on("click", function () {
                $('#shop-cart-preview').slideUp('fast');
                $('.user-menu').slideToggle('fast');
            });

            $('.header').next('div').on("click", function () {
                $('.user-menu').slideUp('fast');
            });

            $('.user-menu').on("click", function (e) {
                e.stopPropagation();
            })
        }
    };

    header.toggleMenu($('.btn-user-menu'));
});