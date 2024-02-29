var navbar = document.getElementById("navbar");
var nav = document.getElementById("nav");
var placeholder = document.getElementById("navbar_placeholder");
var sticky = navbar.offsetTop;

window.onscroll = function() {myFunction()};
function myFunction() {
    if (window.pageYOffset > sticky) {
        navbar.classList.add("sticky");
        // placeholder.classList.add("display");
        nav.classList.add("shrink");
    } else {
        navbar.classList.remove("sticky");
        // placeholder.classList.remove("display");
        nav.classList.remove("shrink");
    }
}
const options = {threshold: 0.5};

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        console.log(entry)
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        } else {
            entry.target.classList.remove('show');
        }
    });
}, options);

const hiddenElements = document.querySelectorAll('.hidden');
hiddenElements.forEach((el) => observer.observe(el));