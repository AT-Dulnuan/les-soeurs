$(document).ready(function () {

    // Check for click events on the navbar burger icon
    $(".navbar-burger").click(function () {
        $("body").toggleClass("stop-scroll");
        $("#navOverlay").toggleClass("is-active");
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
