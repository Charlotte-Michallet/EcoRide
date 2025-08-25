import { escapeHtml, errorDisplay } from "./../../global/formValidator.js";

const API_ENDPOINT = "index.php?controller=api&resource=trip&action=feedback";

const form = document.querySelector("form");
const tokenform = document.getElementById("token");
const feedbackTextArea = document.getElementById("feedbackTextArea");
const inputs = document.querySelectorAll("input");
const reserId = document.getElementById("reservationId");

let reservationId = reserId.value;
let token = tokenform.value;
let ratting, feedbacktext;

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
        ratting = null;
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
        feedbacktext = null;
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

const checkForm = (ratting, feedbacktext, reservationId, token) => {
    const rattingSanitized = escapeHtml(ratting);
    const feedbacktextSanitized = escapeHtml(feedbacktext);
    const reservationIdSanitized = escapeHtml(reservationId);

    const data = {
        ratting: rattingSanitized,
        feedbacktext: feedbacktextSanitized,
        reservationId: reservationIdSanitized,
        token,
    };
    return data;
};

// submit form
form.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (ratting && feedbacktext && token) {
        let feedbackData = checkForm(
            ratting,
            feedbacktext,
            reservationId,
            token
        );
        errorDisplay("feedback", "", true);

        try {
            // API
            const resp = await fetch(API_ENDPOINT, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(feedbackData),
            });

            const responseData = await resp.json();

            if (resp.status == 401) {
                errorDisplay(
                    "feedback",
                    responseData.message ||
                        "Le pseudo ou l'adresse mail exist déjà."
                );
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
    } else {
        errorDisplay("feedback", "Veillez remplir tout les champs.");
    }
});
