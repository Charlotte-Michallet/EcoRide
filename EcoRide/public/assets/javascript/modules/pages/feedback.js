import { escapeHtml, errorDisplay } from "./../../global/formValidator.js";

const API_ENDPOINT = "index.php?controller=api&resource=trip&action=feedback";

const form = document.querySelector("form");
const tokenform = document.getElementById("token");
const feedbackTextArea = document.getElementById("feedbackTextArea");
const inputs = document.querySelectorAll("input");
const reserId = document.getElementById("reservationId");
const priceinput = document.getElementById("price");
const idDriverinput = document.getElementById("idDriver");
const selectRadio = document.querySelectorAll("input[name='tripIsOk']");

let reservationId = reserId.value;
let price = priceinput.value;
let idDriver = idDriverinput.value;
let token = tokenform.value;
let ratting = false;
let feedbacktext = false;
let tripStatus;

selectRadio.forEach((input) => {
    input.addEventListener("input", (e) => {
        switch (e.target.id) {
            case "tripNotOk":
                checkInput(e.target.value);
                break;

            case "tripOk":
                checkInput(e.target.value);
                break;

            default:
                null;
                break;
        }
    });
});

// foreach input call function
inputs.forEach((input) => {
    input.addEventListener("input", (e) => {
        switch (e.target.id) {
            case "1star":
                rattingCheck(e.target.value);
                break;

            case "2stars":
                rattingCheck(e.target.value);
                break;

            case "3stars":
                rattingCheck(e.target.value);
                break;

            case "4stars":
                rattingCheck(e.target.value);
                break;

            case "5stars":
                rattingCheck(e.target.value);
                break;

            default:
                null;
                break;
        }
    });
});

const rattingCheck = (value) => {
    if (isNaN(value)) {
        errorDisplay("feedback", "Ce champs doit contenir que des chiffre");
        ratting = false;
    } else if (value.length === 0) {
        errorDisplay("feedback", "Le champs doit etre renseigne");
        ratting = null;
    } else if (value < 1 || value > 5) {
        errorDisplay("feedback", "Le nombre de place doit etre entre 1 et 8");
        ratting = null;
    } else {
        errorDisplay("feedback", "", true);
        ratting = value;
    }
};

feedbackTextArea.addEventListener("input", (e) => {
    let value = e.target.value;

    if (value.length === 0) {
        errorDisplay("feedback", "Le champs ne doit pas etre vide.");
        feedbacktext = false;
    } else if (!value.match(/^[a-zA-Z0-9\s\-.&+\/()[\]!,;:\é\è\à\ç\ù]+$/)) {
        errorDisplay(
            "feedback",
            "Le champs ne doit pas contenir de caractère spéciaux."
        );
        feedbacktext = null;
    } else {
        errorDisplay("feedback", "", true);
        feedbacktext = value;
    }
});

const checkInput = (value) => {
    if (value !== "Oui" && value !== "Non") {
        errorDisplay("feedback", "Le champs ne doit pas etre vide.");
        tripStatus = null;
    } else {
        errorDisplay("feedback", "", true);
        tripStatus = value;
    }
};

const checkFormTripOk = (tripStatus, reservationId, token, idDriver, price) => {
    const tripStatusSanitized = escapeHtml(tripStatus);
    const reservationIdSanitized = escapeHtml(reservationId);
    const idDriverSanitized = escapeHtml(idDriver);
    const priceSanitized = escapeHtml(price);

    const data = {
        tripStatus: tripStatusSanitized,
        reservationId: reservationIdSanitized,
        idDriver: idDriverSanitized,
        price: priceSanitized,
        token,
    };
    return data;
};
const checkFormRatting = (
    tripStatus,
    ratting,
    reservationId,
    idDriver,
    price,
    token
) => {
    const tripStatusSanitized = escapeHtml(tripStatus);
    const rattingSanitized = escapeHtml(ratting);
    const reservationIdSanitized = escapeHtml(reservationId);
    const idDriverSanitized = escapeHtml(idDriver);
    const priceSanitized = escapeHtml(price);

    const data = {
        tripStatus: tripStatusSanitized,
        ratting: rattingSanitized,
        reservationId: reservationIdSanitized,
        idDriver: idDriverSanitized,
        price: priceSanitized,
        token,
    };
    return data;
};

const checkForm = (
    tripStatus,
    ratting,
    feedbacktext,
    reservationId,
    idDriver,
    price,
    token
) => {
    const tripStatusSanitized = escapeHtml(tripStatus);
    const rattingSanitized = escapeHtml(ratting);
    const feedbacktextSanitized = escapeHtml(feedbacktext);
    const reservationIdSanitized = escapeHtml(reservationId);
    const idDriverSanitized = escapeHtml(idDriver);
    const priceSanitized = escapeHtml(price);

    const data = {
        tripStatus: tripStatusSanitized,
        ratting: rattingSanitized,
        feedbacktext: feedbacktextSanitized,
        reservationId: reservationIdSanitized,
        idDriver: idDriverSanitized,
        price: priceSanitized,
        token,
    };
    return data;
};
const api = async (feedbackData) => {
    try {
        // API
        const resp = await fetch(API_ENDPOINT, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(feedbackData),
        });
        const responseData = await resp.json();
        console.log(feedbackData);

        if (resp.status == 401) {
            errorDisplay("feedback", responseData.message);
        } else if (resp.ok) {
            const succes = document.getElementById("sendSuccess");
            succes.classList.remove("hidden");
            succes.textContent = `Votre message a bienété envoyé.`;
            setTimeout(() => {
                window.location.href =
                    "/index.php?controller=trips&action=manageTrip";
                succes.classList.add("hidden");
                succes.textContent = "";
            }, 1000);
        } else {
            errorDisplay("feedback", responseData.message);
        }
    } catch (error) {
        alert(`L'envoie a échoue : ${error.message}`);
    }
};

// submit form
form.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (
        tripStatus &&
        reservationId &&
        token &&
        idDriver &&
        price &&
        ratting === false &&
        feedbacktext === false
    ) {
        let feedbackData = checkFormTripOk(
            tripStatus,
            reservationId,
            token,
            idDriver,
            price
        );
        api(feedbackData);
        errorDisplay("feedback", "", true);
    } else if (
        tripStatus &&
        ratting &&
        reservationId &&
        token &&
        idDriver &&
        price &&
        feedbacktext === false
    ) {
        let feedbackData = checkFormRatting(
            tripStatus,
            ratting,
            reservationId,
            idDriver,
            price,
            token
        );
        errorDisplay("feedback", "", true);
        api(feedbackData);
    } else if (
        tripStatus &&
        ratting &&
        feedbacktext &&
        reservationId &&
        idDriver &&
        price &&
        token
    ) {
        let feedbackData = checkForm(
            tripStatus,
            ratting,
            feedbacktext,
            reservationId,
            idDriver,
            price,
            token
        );
        api(feedbackData);
        errorDisplay("feedback", "", true);
    } else {
        errorDisplay("feedback", "Veillez remplir les champs.");
    }
});
