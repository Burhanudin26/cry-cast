// screen
$(window).on("load", function () {
    $("body").addClass("loaded");
});
// navar
window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    navbar.classList.toggle("scrolled", window.scrollY > 0);
});
