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
    //nama validation
    $("#name").keyup(function () {
        let nama = $("#name").val();
        if (nama.length > 3 && isNaN(nama)) {
            $("#name").removeClass("is-invalid");
            $("#name").addClass("is-valid");
            $("#name").next().next().text("");
        } else {
            $("#name").removeClass("is-valid");
            $("#name").addClass("is-invalid");
            $("#name")
                .next()
                .next()
                .text("nama must be string and length must be greater than 3");
        }
    });
    //email validation
    $("#email").keyup(function () {
        let email = $("#email").val();
        if (email.length > 6 && email.includes("@") && email.includes(".")) {
            $("#email").removeClass("is-invalid");
            $("#email").addClass("is-valid");
            $("#email").next().next().text("");
        } else {
            $("#email").removeClass("is-valid");
            $("#email").addClass("is-invalid");
            $("#email").next().next().text("email must be valid email");
        }
    });

    //password validation must greater than 6 and use regex to check if password contain number and string
    $("#password").keyup(function () {
        let password = $("#password").val();
        let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (password.length > 6 && regex.test(password)) {
            $("#password").removeClass("is-invalid");
            $("#password").addClass("is-valid");
            $("#password").next().next().text("");
            $("#pashelp").show();
        } else {
            $("#password").removeClass("is-valid");
            $("#password").addClass("is-invalid");
            $("#password")
                .next()
                .next()
                .text(
                    "password length must be greater than 6 and must contain number, lowercase and uppercase"
                );
            $("#rpass").removeClass("is-valid");
            $("#pashelp").hide();
        }
    });

    // confirm password validation
    $("#rpass").keyup(function () {
        let rpass = $("#rpass").val();
        let password = $("#password").val();
        if (rpass == password) {
            $("#rpass").removeClass("is-invalid");
            $("#rpass").addClass("is-valid");
            $("#rpass").next().next().text("");
        } else {
            $("#rpass").removeClass("is-valid");
            $("#rpass").addClass("is-invalid");
            $("#rpass").next().next().text("password not match");
        }
    });
    // Add event listener to show password button
    $("#showpass")
        .off()
        .on("click", function () {
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

    // login validation function for the login page

    //email validation
    $("#name_or_email").keyup(function () {
        let email = $("#name_or_email").val();
        if (email.length > 6 && email.includes("@") && email.includes(".")) {
            $("#name_or_email").removeClass("is-invalid");
            $("#name_or_email").addClass("is-valid");
            $("#name_or_email").next().next().text("");
        } else {
            $("#name_or_email").removeClass("is-valid");
            $("#name_or_email").addClass("is-invalid");
            $("#name_or_email").next().next().text("email must be valid email");
        }
    });

    //password validation must greater than 6 and use regex to check if password contain number and string
    $("#password").keyup(function () {
        let password = $("#password").val();
        let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (password.length > 6 && regex.test(password)) {
            $("#password").removeClass("is-invalid");
            $("#password").addClass("is-valid");
            $("#password").next().next().text("");
            $("#error-message").show();
        } else {
            $("#password").removeClass("is-valid");
            $("#password").addClass("is-invalid");
            $("#password")
                .next()
                .next()
                .text(
                    "password length must be greater than 6 and must contain number, lowercase and uppercase"
                );
            $("#rpass").removeClass("is-valid");
            $("#error-message").hide();
        }
    });

    //validation on submit
    $("#submit").click(function () {
        let email = $("#name_or_email").val();
        let password = $("#password").val();
        let rpass = $("#rpass").val();
        let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (
            nama.length > 3 &&
            isNaN(nama) &&
            email.length > 6 &&
            email.includes("@") &&
            email.includes(".") &&
            password.length > 6 &&
            regex.test(password) &&
            rpass == password
        ) {
            // enable submit button if all validation is true
        } else {
            alert("form invalid");
        }
    });

    $("#submitLoginLogin").addClass("disabled");
    $("input").keyup(function () {
        let email = $("#name_or_email").val();
        let password = $("#password").val();
        let rpass = $("#rpass").val();
        let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (
            nama.length > 3 &&
            isNaN(nama) &&
            email.length > 6 &&
            email.includes("@") &&
            email.includes(".") &&
            password.length > 6 &&
            regex.test(password) &&
            rpass == password
        ) {
            $("#submitLogin").removeClass("disabled");
        } else {
            $("#submitLogin").addClass("disabled");
        }
    });
    // End of Login Validation

    //enable submit button if registration validation is true
    $("#submit").addClass("disabled");
    $("input").keyup(function () {
        let nama = $("#name").val();
        let email = $("#email").val();
        let password = $("#password").val();
        let rpass = $("#rpass").val();
        let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (
            nama.length > 3 &&
            isNaN(nama) &&
            email.length > 6 &&
            email.includes("@") &&
            email.includes(".") &&
            password.length > 6 &&
            regex.test(password) &&
            rpass == password
        ) {
            $("#submit").removeClass("disabled");
        } else {
            $("#submit").addClass("disabled");
        }
    });
    // modal rerun
    // $(document).ready(function () {
    $("#tips").modal("show"); // modal is for tips
    // });

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
