import { escapeHtml, errorDisplay } from "./../../global/formValidator.js";

const API_ENDPOINT = "index.php?controller=api&resource=profil&action=addCar";
const btnOpenModal = document.getElementById("btnOpenModal");
const closeModal = document.getElementById("closeModal");
const addCarModal = document.getElementById("addCarModal");
const addCaroverlay = document.getElementById("addCaroverlay");
const addCarForm = document.getElementById("addCarForm");
const carInputs = [
    brandCreate,
    modelCreate,
    numSpaces,
    nbPlate,
    dateNbPlate,
    colorCreate,
];

let token = tokenCsrf.value;
let brand, model, energy, seats, numPlate, dateRegister, color;

// Open close modal
btnOpenModal.addEventListener("click", () => {
    addCaroverlay.classList.remove("hidden");
    addCarModal.classList.remove("hidden");
});

closeModal.addEventListener("click", () => {
    addCaroverlay.classList.add("hidden");
    addCarModal.classList.add("hidden");
});

carInputs.forEach((input) => {
    input.addEventListener("input", (e) => {
        switch (e.target.id) {
            case "brandCreate":
                brandCheck(e.target.value);
                break;

            case "modelCreate":
                modelCheck(e.target.value);
                break;

            case "numSpaces":
                seatsCheck(e.target.value);
                break;

            case "nbPlate":
                numPlateCheck(e.target.value);
                break;

            case "dateNbPlate":
                dateRegisterCheck(e.target.value);
                break;

            case "colorCreate":
                colorCheck(e.target.value);
                break;

            default:
                break;
        }
    });
});

//verify brand and model
const brandCheck = (value) => {
    if (value.length > 0 && value.length > 30) {
        errorDisplay("brand", "La marque ne doit pas dépasser 30 caractères.");
        brand = null;
    } else if (!value.match(/^[a-zA-Z0-9\s\-.&+\/()[\]]+$/)) {
        errorDisplay(
            "brand",
            "La marque doit ne doit pas contenir de caractère spéciaux."
        );
        brand = null;
    } else {
        errorDisplay("brand", "", true);
        brand = value;
    }
};

//verify model
const modelCheck = (value) => {
    if (value.length > 0 && value.length > 30) {
        errorDisplay("model", "Le modèle ne doit pas dépasser 30 caractères.");
        model = null;
    } else if (!value.match(/^[a-zA-Z0-9\s\-.&+\/()[\]]+$/)) {
        errorDisplay(
            "model",
            "Le modèle ne doit pas contenir de caractères spéciaux."
        );
        model = null;
    } else {
        errorDisplay("model", "", true);
        model = value;
    }
};

// verify energy type
energyType.addEventListener("change", (e) => {
    let energyType = e.target.value;

    if (energyType === "Energy") {
        errorDisplay("form", "Veuillez choisir un type d'énergie");
        energy = null;
    } else {
        energy = energyType;
        errorDisplay("form", "", true);
    }
});

// verify number seats
const seatsCheck = (value) => {
    if (Number.isNaN(value)) {
        errorDisplay("seats", "Ce champ doit contenir uniquement des chiffres");
        seats = null;
    } else if (value.length === 0) {
        errorDisplay("seats", "Le champ doit être renseigné");
        seats = null;
    } else if (value < 2 || value > 9) {
        errorDisplay(
            "seats",
            "Le nombre de places doit être compris entre 2 et 9"
        );
        seats = null;
    } else {
        errorDisplay("seats", "", true);
        seats = value;
    }
};

//verify number plate
const numPlateCheck = (value) => {
    if (
        !value.match(/^[A-HJ-NP-TV-Z]{2}[- ]?\d{3}[- ]?[A-HJ-NP-TV-Z]{2}$/i) &&
        !value.match(/^\d{1,4}[ ]?[A-Z]{1,3}[ ]?\d{2}$/i)
    ) {
        errorDisplay(
            "numplate",
            "La plaque d'immatriculation ne correspond pas au standard."
        );
        numPlate = null;
    } else {
        errorDisplay("numplate", "", true);
        numPlate = value;
    }
};

// verify date firts register
const dateRegisterCheck = (value) => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    let dateR = new Date(value);
    dateR.setHours(0, 0, 0, 0);

    if (dateR > today) {
        errorDisplay(
            "datenumplate",
            "Veuillez mettre une date antérieure ou égale à aujourd'hui."
        );
        dateRegister = null;
    } else {
        errorDisplay("datenumplate", "", true);
        dateRegister = value;
    }
};

//verify color
const colorCheck = (value) => {
    if (value.length === 0) {
        errorDisplay("form", "Le champ doit être renseigné");
        color = null;
    } else if (!value.match(/^[a-zA-Z\s]*[a-zA-Z][a-zA-Z\s]*$/)) {
        errorDisplay(
            "form",
            "La couleur ne doit pas contenir de caractères spéciaux"
        );
        color = null;
    } else {
        errorDisplay("form", "", true);
        color = value;
    }
};

const checkForm = (
    brand,
    model,
    energy,
    seats,
    numPlate,
    dateRegister,
    color,
    token
) => {
    const brandSanitized = escapeHtml(brand);
    const modelSanitized = escapeHtml(model);
    const energySanitized = escapeHtml(energy);
    const seatsSanitized = escapeHtml(seats);
    const numPlateSanitized = escapeHtml(numPlate);
    const dateRegisterSanitized = escapeHtml(dateRegister);
    const colorSanitized = escapeHtml(color);

    const data = {
        brand: brandSanitized,
        model: modelSanitized,
        energy: energySanitized,
        seats: seatsSanitized,
        numPlate: numPlateSanitized,
        dateRegister: dateRegisterSanitized,
        color: colorSanitized,
        token,
    };
    return data;
};

// submit form
addCarForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    // if all variables are true (not null)
    if (
        brand &&
        model &&
        energy &&
        seats &&
        numPlate &&
        dateRegister &&
        color &&
        token
    ) {
        errorDisplay("form", "", true);

        let carData = checkForm(
            brand,
            model,
            energy,
            seats,
            numPlate,
            dateRegister,
            color,
            token
        );

        try {
            // API
            const resp = await fetch(API_ENDPOINT, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                credentials: "include",
                body: JSON.stringify(carData),
            });

            const responseData = await resp.json();

            if (resp.ok) {
                window.location.href = "/index.php?controller=auth&action=cars";
            } else {
                errorDisplay("form", responseData.message);
            }
        } catch (error) {
            alert(`L'ajout de la voiture a échoué : ${error.message}`);
        }
    } else {
        errorDisplay("form", "Veuillez remplir tous les champs.");
    }
});
