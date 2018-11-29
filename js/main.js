window.addEventListener("load", function () {
    //Prevent href="#" Anchors in the navigation from jumping to scroll(0, 0)
    const dirs = document.getElementsByClassName("dir");
    for (let i = 0; i < dirs.length; i++) {
        dirs[i].firstChild.addEventListener("click", event => {
            event.preventDefault();
        });
    }

    //Adding a smooth scrolling to the scroll-top link
    const scrollTopButton = document.getElementById("scroll-top");
    scrollTopButton.addEventListener("click", event => {
        event.preventDefault();
        window.scroll({
            top: 0,
            behavior: 'smooth'
        });
    });

    //View toggler for Imprint page
    if (document.querySelector("#expander")) {
        document.querySelector("#expander").addEventListener("click", () => {
            document.querySelector(".expandable").classList.toggle("collapsed");
        });
    }
});