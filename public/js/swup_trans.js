const swup = new Swup();

// Remove event listeners and clean up previous parallax elements
swup.on("willReplaceContent", function () {
    window.removeEventListener("scroll", i);
    window.removeEventListener("resize", i);
    var parallaxElems = document.querySelectorAll("[data-bss-parallax-bg]");
    for (var i = 0; i < parallaxElems.length; i++) {
        var parallaxElem = parallaxElems[i];
        var parallaxWrapper = parallaxElem.parentNode;
        parallaxWrapper.style.background = "";
        parallaxWrapper.style.overflow = "";
        var parallaxChild = parallaxWrapper.firstChild;
        if (parallaxChild !== parallaxElem) {
            parallaxWrapper.insertBefore(parallaxElem, parallaxChild);
        }
        parallaxWrapper.removeChild(parallaxChild);
    }
});

swup.on("contentReplaced", function () {
    // Add event listener to show password button
    $("#showpass").off().on("click", function () {
      if ($("#password").attr("type") === "password") {
        $("#password").attr("type", "text");
        $("#rpass").attr("type", "text");
        $("#showpass").text("Hide Password");
      } else {
        $("#password").attr("type", "password");
        $("#rpass").attr("type", "password");
        $("#showpass").text("Show Password");
      }
    });
    
    // Re-run the parallax code on the new content
    if ("requestAnimationFrame" in window) {
        var e = [],
            t = document.querySelectorAll("[data-bss-parallax-bg]");
        for (var n of t) {
            var a = document.createElement("div");
            a.style.backgroundImage = n.style.backgroundImage;
            a.style.backgroundSize = "cover";
            a.style.backgroundPosition = "center";
            a.style.position = "absolute";
            a.style.height = "200%";
            a.style.width = "100%";
            a.style.top = 0;
            a.style.left = 0;
            a.style.zIndex = -100;
            n.appendChild(a);
            e.push(a);
            n.style.position = "relative";
            n.style.background = "transparent";
            n.style.overflow = "hidden";
        }
        if (e.length) {
            var o,
                r = [];
            window.addEventListener("scroll", i);
            window.addEventListener("resize", i);
            i();
        }
    }
    function i() {
        r.length = 0;
        for (var t = 0; t < e.length; t++) {
            var n = e[t].parentNode.getBoundingClientRect();
            n.bottom > 0 &&
                n.top < window.innerHeight &&
                r.push({
                    rect: n,
                    node: e[t],
                });
        }
        cancelAnimationFrame(o);
        r.length && (o = requestAnimationFrame(l));
    }

    function l() {
        for (var e = 0; e < r.length; e++) {
            var t = r[e].rect,
                n = r[e].node,
                a = Math.max(t.bottom, 0) / (window.innerHeight + t.height);
            n.style.transform = "translate3d(0, " + -50 * a + "%, 0)";
        }
    }
});


