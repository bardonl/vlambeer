$(document).ready(function () {

    // functions

    function getRandomNr(max, min) {
        return Math.floor(Math.random() * (max - min) + min);
    }

    function checkUrl(search){
        if(window.location.href.includes(search)){
            return true;
        }
    }

    var randomNr = getRandomNr(1999,1700);

    // Single try scripts
    $('#slogan-script').html(randomNr);
    $('#slogan-script2').html(randomNr);

    $('.large-img').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        autoplay: true,
        asNavFor: '.small-images'
    });
    $('.small-images').slick({
        slidesToShow: 3, // 3,
        slidesToScroll: 1,
        asNavFor: '.large-img',
        dots: true,
        centerMode: true,
        focusOnSelect: true
    });

    $('.glyphicon-menu-down').click(function(){
        $(this).toggleClass('glyphicon-menu-up');
        $(this).parent().parent().find('.category-items').slideToggle();
    });

    if(checkUrl('games')){
        $('#games').addClass('as-active');
    }
    if(checkUrl('merchandise') || checkUrl('product')){
        $('#merchandise').addClass('as-active');
    }

//    Set height for vertical divider on shop/shopcart_customerinfo page

    $('.divider-vertical').css('height', $('.existing-user').css('height'));

//    Shows or hide extra deliver adress on shop/shopcart_customersaccount page

    $('#extraDeliverAdress').click(function(){
       $('.extraAdress').slideToggle(this.checked);
    });

//    Shows or hide extra password fields on profile/edit-profile page

    $('.password-button').click(function(){
       $('.hidden-fields').slideToggle();
    });

});







