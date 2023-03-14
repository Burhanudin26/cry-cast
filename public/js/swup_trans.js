// Define SwupScrollPlugin
class SwupScrollPlugin {
    name = "SwupScrollPlugin";

    mount() {
        // Set scroll position to top of page on page change
        document.documentElement.scrollTop = 0;
    }
}

// Initialize Swup with SwupScrollPlugin
const swup = new Swup({
    plugins: [new SwupScrollPlugin()],
});
swup.on("animationOutDone", function () {
    window.scrollTo(0, 0);
});
