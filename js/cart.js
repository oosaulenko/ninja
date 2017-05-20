//hidden layers
TweenMax.set($("#pizza_box_hover"), {
    alpha: 0
});

TweenMax.set($("#pizza_box_open"), {
    alpha: 0
});
TweenMax.set($("#face3"), {
    alpha: 0
});
TweenMax.set($("#face2"), {
    alpha: 0
});

//box opening function
$("#pizza_box_closed").on("mouseenter", boxOver);
$("#pizza_box_closed").on("mouseleave", boxOut);
$("#pizza_box_closed").on("click", boxOpenFace);
// $("#pizza_box_open").on("click", boxOpenFace);

function boxOver() {


    TweenMax.to($("#pizza_box_closed"), .1, {
        alpha: 0,
    });
    TweenMax.to($("#pizza_box_hover"), .1, {
        alpha: 1,
    });


    TweenMax.to($("#face3"), .1, {
        alpha: 1,
    });
    TweenMax.to($("#face1"), .1, {
        alpha: 0,
    });
}

function boxOut() {


    TweenMax.to($("#pizza_box_closed"), .1, {
        alpha: 1,
    });
    TweenMax.to($("#pizza_box_hover"), .1, {
        alpha: 0,
    });
    TweenMax.to($("#pizza_box_open"), .1, {
        alpha: 0,
    });



    TweenMax.to($("#face1"), .1, {
        alpha: 1,
    });
    TweenMax.to($("#face2"), .1, {
        alpha: 0,
    });
    TweenMax.to($("#face3"), .1, {
        alpha: 0,
    });
}

function boxOpenFace() {


    TweenMax.to($("#pizza_box_hover"), .1, {
        alpha: 0,
    });
    TweenMax.to($("#pizza_box_open"), .1, {
        alpha: 1,
    });


    TweenMax.to($("#face1"), .1, {
        alpha: 0,
    });
    TweenMax.to($("#face2"), .1, {
        alpha: 1,
    });
    TweenMax.to($("#face3"), .1, {
        alpha: 0,
    });

    // TweenMax.to($("#pizza_box_group"), 5, {
    //     scale: 4,
    //     transformOrigin:"80% 20%",
    //     repeat: 1,
    //     repeatDelay: 2.5,
    //     delay: 1.5,
    //     ease: Power1.easeIn,
    //     yoyo: true
    // });



}

//pizza hover
TweenMax.to($("#pizza"), 1.5, {
    y: -35,
    repeat: -1,
    yoyo: true
});

TweenMax.to($("#pizza_shadow"), 1.5, {
    scale: .5,
    transformOrigin: "50% 30%",
    repeat: -1,
    yoyo: true
});

//cheese dripping

TweenMax.to($("#drip1"), 3, {
    y: 10,
    repeat: -1,
    alpha: 0,
});

TweenMax.to($("#drip2"), 5, {
    y: 15,
    repeat: -1,
    delay: .5,
    alpha: 0,
});

TweenMax.to($("#drip3"), 6, {
    y: 15,
    repeat: -1,
    delay: 3,
    alpha: .5,
});

TweenMax.to($("#drip4"), 4, {
    y: 15,
    repeat: -1,
    delay: 2,
    alpha: .5,
});

TweenMax.to($("#drip5"), 5, {
    y: 15,
    repeat: -1,
    delay: .5,
    alpha: 0,
});

TweenMax.to($("#drip6"), 6, {
    y: 120,
    repeat: -1,
    delay: 1,
    ease: Power1.easeOut,
    alpha: 0,
});

TweenMax.to($("#drip7"), 3, {
    y: 10,
    repeat: -1,
    delay: 1,
    alpha: .5,
});

TweenMax.to($("#drip8"), 4, {
    y: 40,
    repeat: -1,
    delay: 2,
    alpha: 0,
});

TweenMax.to($("#drip9"), 6, {
    y: 50,
    repeat: -1,
    delay: 0,
    alpha: 0,
});

TweenMax.to($("#drip10"), 3, {
    y: 120,
    repeat: -1,
    delay: 3,
    ease: Power2.easeOut,
    alpha: 0,
});

TweenMax.to($("#drip11"), 6, {
    y: 20,
    repeat: -1,
    delay: 2,
    alpha: 1,
});

TweenMax.to($("#drip12"), 5, {
    y: 120,
    repeat: -1,
    delay: 3,
    ease: Power2.easeOut,
    alpha: 0,
});

TweenMax.to($("#drip13"), 3, {
    y: 30,
    repeat: -1,
    delay: 4,
    alpha: 0,
});

TweenMax.to($("#drip14"), 3, {
    y: 20,
    repeat: -1,
    delay: 2,
    alpha: .3,
});

TweenMax.to($("#drip15"), 4, {
    y: 80,
    repeat: -1,
    delay: 1,
    ease: Power3.easeOut,
    alpha: 0,
});

TweenMax.to($("#drip16"), 5, {
    y: 20,
    repeat: -1,
    delay: 2,
    alpha: .3,
});

TweenMax.to($("#drip17"), 3, {
    y: 70,
    repeat: -1,
    delay: 1,
    ease: Power1.easeOut,
    alpha: 0,
});
//end drip sequence

//Sparkly eye sequence

TweenMax.to($("#sparkle1"), 1, {
    transformOrigin:"50% 50%",
    x: 2,
    repeat: -1,
    delay: 1,
    yoyo: true
});

TweenMax.to($("#sparkle2"), 1, {
    scale: 1.5,
    transformOrigin:"50% 50%",
    repeat: -1,
    delay: 1,
    yoyo: true
});

TweenMax.to($("#sparkle3"), 1, {
    transformOrigin:"50% 50%",
    x: 2,
    repeat: -1,
    delay: 1,
    yoyo: true
});

TweenMax.to($("#sparkle4"), 1, {
    scale: 1.5,
    transformOrigin:"50% 50%",
    repeat: -1,
    delay: 1,
    yoyo: true
});

