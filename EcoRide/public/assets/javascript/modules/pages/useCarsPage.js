const btnOpenModal = document.getElementById("btnOpenModal");
const btnAddCar = document.getElementById("btnAddCar");
const closeModal = document.getElementById("closeModal");
const addCarModal = document.getElementById("addCarModal");
const addCaroverlay = document.getElementById("addCaroverlay");
const addCarForm = document.getElementById("addCarForm");
const inputs = document.querySelectorAll("input, select");
console.log(inputs);

export function init() {
    console.log("hello");

    // Open close modal
    btnOpenModal.addEventListener("click", () => {
        addCaroverlay.classList.toggle("hidden");
        addCarModal.classList.toggle("hidden");
    });

    closeModal.addEventListener("click", () => {
        addCaroverlay.classList.toggle("hidden");
        addCarModal.classList.toggle("hidden");
    });

    btnAddCar.addEventListener("click", () => {
        addCaroverlay.classList.toggle("hidden");
        addCarModal.classList.toggle("hidden");
    });

    // form handler

    addCarForm.addEventListener("submit", (e) => {
        e.preventDefault();
    });
}

function checkform() {
    console.log("qfef");
}
