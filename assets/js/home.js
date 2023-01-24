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
// document.getElementById("show-navbar").addEventListener("click", function () {
//     console.log("show navbar");
//     document.getElementById("navbar").classList.toggle("show");
// });

// hide navbar when click outside if it contains class show
// document.addEventListener("click", function () {
//     if (document.getElementById("navbar").classList.contains("show")) {
//         document.getElementById("navbar").classList.remove("show");
//     }
// });
