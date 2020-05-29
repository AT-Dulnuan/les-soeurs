$(document).ready(function () {

    $(".navbar-burger").click(function () {
        $("body").toggleClass("stop-scroll");
        $(".navbar-burger").toggleClass("is-active");
        $(".menu-mobile").toggleClass("open");
        $(".navmenu").toggleClass("open");
    });
});

$("#image-gallery").on('onBeforeOpen.lg', function (event) {
    $("body").addClass("stop-scroll");
});

$("#image-gallery").on("onCloseAfter.lg", function (event) {
    $("body").removeClass("stop-scroll");
})

function sliderTextReveal() {
    setTimeout(() => {
        $(".text").addClass("onImage");
    }, 500);
    setTimeout(() => {
        $(".text").removeClass("onImage");
    }, 6000);
}


$(".image-slider").on('afterChange', function (event, slick, currentSlide) {
    sliderTextReveal();
});

$(".image-slider").on('init', function (event, slick) {
    sliderTextReveal();
});

$(".image-slider").slick({
    autoplay: true,
    arrows: false,
    autoplaySpeed: 7000,
    pauseOnFocus: false,
    pauseOnHover: false,
    swipe: false
});