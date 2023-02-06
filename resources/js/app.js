import "./bootstrap";
import Alpine from "alpinejs";
import Typed from "typed.js";

window.Alpine = Alpine;

Alpine.start();

const el = document.querySelector("#te");
const val = document.querySelector("#result").value;
const options = {
    strings: [val],
    typeSpeed: 40,
    showCursor: false,
};

const typed = new Typed(el, options);
