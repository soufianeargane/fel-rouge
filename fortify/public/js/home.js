// toggle navba

document.addEventListener("click", function (e) {
    if (
        e.target.classList.contains("icon__nav") ||
        e.target.classList.contains("bi-list")
    ) {
        document.getElementById("navbar").classList.toggle("show");
    } else if (!e.target.classList.contains("navv")) {
        document.getElementById("navbar").classList.remove("show");
    }
});
