const form = document.querySelector("#textForm");
const btn = document.querySelector("#summarizeBtn");

form.addEventListener("submit", function (e) {
    btn.disabled = true;
    btn.style.cursor = "not-allowed";
    btn.innerHTML = "Processing...";
});
