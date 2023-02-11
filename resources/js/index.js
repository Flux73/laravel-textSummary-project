import Typed from "typed.js";

const form = document.querySelector("#textForm");
const el = document.querySelector("#summary");
const val = document.querySelector("#result").value;
const btn = document.querySelector("#summarizeBtn");

form.addEventListener("submit", function (e) {
    btn.disabled = true;
    btn.style.cursor = "not-allowed";
    btn.innerHTML = "Processing...";
});

const options = {
    strings: [val],
    typeSpeed: 40,
    showCursor: false,
};

const typed = new Typed(el, options);