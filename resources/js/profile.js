const texts = document.querySelectorAll(".textContainer");
const overlay = document.querySelector("#overlay");
let modal;

overlay.addEventListener("click", (e) => {
    overlay.classList.add("hidden");
    modal.classList.add("hidden");
});

texts.forEach((text, i) => {
    text.addEventListener("click", (e) => {
        if (
            e.target === document.querySelector("#trashBtn") ||
            e.target === document.querySelector("#starBtn")
        )
            return;

        modal = document.querySelector(`#modal-${i}`);
        overlay.classList.remove("hidden");
        modal.classList.remove("hidden");

        document.querySelector(`#close-${i}`).addEventListener("click", (e) => {
            overlay.classList.add("hidden");
            modal.classList.add("hidden");
        });
    });
});

window.addEventListener("keyup", (e) => {
    console.log(e.key !== "Escape");
    if (e.key !== "Escape" || overlay.className.includes("hidden")) return;

    overlay.classList.add("hidden");
    modal.classList.add("hidden");
});
