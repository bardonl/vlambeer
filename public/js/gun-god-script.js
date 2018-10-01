/**
 * Created by kobus on 12/12/2016.
 */
$(window).on("mouseover", function() {
    var center = Math.floor(window.innerWidth/2);
    var halfCenter = center / 2;
    var rightCenter = center + halfCenter;

    var ggText = $('#gun-god-logo');

    if(event.pageX < halfCenter) {
        ggText.removeClass();
        ggText.addClass('gg-text-plus-last');
    } else if(event.pageX < center && event.pageX > halfCenter) {
        ggText.removeClass();
        ggText.addClass('gg-text-plus-first');
    } else if(event.pageX == center) {
        ggText.removeClass();
    } else if(event.pageX > center && event.pageX < rightCenter) {
        ggText.removeClass();
        ggText.addClass('gg-text-min-first');
    } else if (event.pageX > rightCenter) {
        ggText.removeClass();
        ggText.addClass('gg-text-min-last');
    }


});