
/**
 * Created by bart_ on 27-Dec-16.
 */
$(document).ready(function() {
    var bonefish1 = $('#bonefish1');
    var bonefish2 = $('#bonefish2');
    var bonefish3 = $('#bonefish3');
    var bonefish4 = $('#bonefish4');
    var guppy = $('#guppy');
    var guppy1 = $('#guppy1');
    var guppy2 = $('#guppy2');
    var guppy3 = $('#guppy3');
    var guppy4 = $('#guppy4');
    var fishtank = $('#fishtank');
    bonefish1.mouseenter(function(){
        console.log("stop it!");
//                bonefish1.clearQueue();
        bonefish1.animate({
            left:(Math.random()*200)+'px',
            top:(Math.random()*200)+'px'
        });

    });
    animateDiv(bonefish1, fishtank);
    animateDiv(bonefish2, fishtank);
    animateDiv(bonefish3, fishtank);
    animateDiv(bonefish4, fishtank);
    animateDiv(guppy, fishtank);
    animateDiv(guppy1, fishtank);
    animateDiv(guppy2, fishtank);
    animateDiv(guppy3, fishtank);
    animateDiv(guppy4, fishtank);
    setInterval(function(){
        animateDiv(bonefish1, fishtank);
        animateDiv(bonefish2, fishtank);
        animateDiv(bonefish3, fishtank);
        animateDiv(bonefish4, fishtank);
        animateDiv(guppy, fishtank);
        animateDiv(guppy1, fishtank);
        animateDiv(guppy2, fishtank);
        animateDiv(guppy3, fishtank);
        animateDiv(guppy4, fishtank);
    },40000);


    function makeNewPosition(tank, target) {

        // Get viewport dimensions (remove the dimension of the div)
        var h = tank.height() - 70;
        var w = tank.width() - 70;

        var nh = Math.floor(Math.random() * h);
        var nw = Math.floor(Math.random() * w);

        var oldPos =  target.position();
        var oldPosX = oldPos.left;
        console.log("New y Pos : "+nh);
        if(fishtank.offsetHeight > target){
            makeNewPosition(tank, target);
        }
        if (nw > oldPosX){
            target.addClass('mirror');
        }else{
            target.removeClass('mirror');
        }
        return [nh, nw];
    }

    function animateDiv(target, tank) {
        var newq = makeNewPosition(tank, target);
        target.animate({
            top: newq[0],
            left: newq[1]
        }, 40000);
    }

    function animateFast(target, tank) {
        var newq = makeNewPosition(tank, target);
        target.animate({
            top: newq[0],
            left: newq[1]
        }, 3500);
    }
    swing('#sign');

    function swing(target) {
        // the values in vars can (and should) be tweaked to modify the way the swing works
        // * = affected by power
        var vars = {
            origin: 'top center',   // transformOrigin
            perspective: 900,       // transformPerspective
            ease: Power1.easeInOut, // an easeInOut should really be used here...
            power: 0.5,               // multiplier for the effect that is reduced to 0 over the duration
            duration: 5,            // total length of the effect (well, it can be up to vars.speed longer than this)
            rotation: -80,          // start rotation, also stores target rotations during tween
            maxrotation: 60,        // * max rotation after starting
            speed: 1,             // minimum duration for each swing
            maxspeed: 0.01           // * extra duration to add to the larger swings (any sort of real physics seems like overkill)
        };

        // target could be a string selector (it will be selected each swing though...), or a DOM or jQuery object
        vars.target = target;

        // starting position
        TweenMax.set(vars.target, { rotationX: vars.rotation, transformOrigin: vars.origin, transformPerspective: vars.perspective });

        TweenMax.to(vars, vars.duration, { power: 0, delay: 1, onStart: nextSwing, onStartParams: [vars] });
    }

        function nextSwing(vars) {
            if (vars.power > 0) {
                vars.rotation = (vars.rotation > 0 ? -1 : 1) * vars.maxrotation * vars.power;
                TweenMax.to(vars.target, vars.speed + vars.maxspeed * vars.power, { rotationX: vars.rotation, ease: vars.ease, onComplete: nextSwing, onCompleteParams: [vars] });
            } else {
                TweenMax.to(vars.target, vars.speed, { rotationX: 0, ease: vars.ease, clearProps: 'all' });
            }
        }
        function backgroundScroll(el, width, speed){
            el.animate({'background-position' : '-'+width+'px'}, speed, 'linear', function(){
                el.css('background-position','0');
                backgroundScroll(el, width, speed);
            });
        }
        function backgroundScrollBack(el, width, speed){
            el.animate({'background-position' : width+'px'}, speed, 'linear', function(){
                el.css('background-position','0');
                backgroundScrollBack(el, width, speed);
            });
        }
        // 948 represents the width of the image in pixels and 60000 represents the speed it scrolls
        backgroundScroll($('.main-content-fishing'), 960, 80000);
        backgroundScroll($(fishtank), 960, 60000);
        backgroundScrollBack($('#foam'), 960, 60000);
});