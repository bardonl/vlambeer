/**
 * Created by bart_ on 20-Dec-16.
 */
$(document).ready(function(){
var logo = $('.logo');
var topbullet = $('.top-bullet');
var topshot = $('.top-shot');
var bottombullet = $('.bottom-bullet');
var bottomshot = $('.bottom-shot');


//Hover for the logo to start the animation
logo.mouseenter(function(){
    moveBulletLeft();
});

//Stop the animation when the mouse leaves the logo
logo.mouseleave(function(){
    topbullet.stop(true,true);
    topshot.stop(true,true);
    bottombullet.stop(true,true);
    bottomshot.stop(true,true);
    //Move the sprites to it's start position
    moveStartAll();
});

//Function to move the bullet to the left and animate the muzzle shot
function moveBulletLeft(){
    //Move the topbullet to the left and slowly fade away
    topbullet.animate({
        'left' : '205px',
        opacity: 0
    }, 500);
    //Move the bottombullet to the left with a slow fade and a delay
    bottombullet.delay(50).animate({
        'left' : '70px',
        opacity: 0
    }, 500);
    //Animate the muzzleshot
    topshot.animate({
        opacity: 1
    }, 0);
    //Animate muzzleshot with a delay
    bottomshot.delay(50).animate({
        opacity: 1
    }, 0);
    //Move the bullets to it's start position
    moveBulletStartPos();
}

//Function to move the bullet to its start posistion
function moveBulletStartPos(){
    topbullet.animate({
        'left' : '405px',
        opacity: 1
    }, 0);
    bottombullet.animate({
        'left' : '270px',
        opacity: 1
    }, 0);
    topshot.animate({
        opacity: 0
    }, 500);
    bottomshot.animate({
        opacity: 0
    }, 500);
    moveBulletLeft();
}

//Reset the animation of the complete animations

function moveStartAll(){
    topbullet.animate({
        'left' : '405px',
        opacity: 0
    }, 0);
    bottombullet.animate({
        'left' : '195px',
        opacity: 0
    }, 0);
    topshot.animate({
        opacity: 0
    }, 0);
    bottomshot.animate({
        opacity: 0
    }, 0);
}

});