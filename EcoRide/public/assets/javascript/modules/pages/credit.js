import { escapeHtml, errorDisplay } from "./../../global/formValidator.js";

const API_ENDPOINT = "index.php?controller=api&resource=profil&action=credit";

let credits;

const form = document.querySelector("form");
const input = document.getElementById("credits");

let token = tokenCsrf.value;

input.addEventListener("input", (e) => {
    let value = Number(e.target.value);

    if (Number.isNaN(value) || !Number.isInteger(value)) {
        errorDisplay("form", "Ce champ doit contenir uniquement des chiffres");
        credits = null;
    } else if (value.length === 0) {
        errorDisplay("form", "Le champ doit être renseigné");
        credits = null;
    } else if (value < 1) {
        errorDisplay("form", "Vous devez entrer un minimum de 1 €.");
        credits = null;
    } else {
        errorDisplay("form", "", true);
        credits = value;
    }
});

// submit form
form.addEventListener("submit", async (e) => {
    e.preventDefault();
    if (credits) {
        const creditsSanitized = escapeHtml(credits);

        const data = {
            credits: creditsSanitized,
            token,
        };

        try {
            // API
            const resp = await fetch(API_ENDPOINT, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data),
            });

            const responseData = await resp.json();
            const succes = document.getElementById("succes");

            if (resp.ok) {
                succes.classList.remove("hidden");
                succes.textContent = `Votre compte a bien été credité.`;

                setTimeout(() => {
                    window.location.href =
                        "/index.php?controller=auth&action=profil";

                    succes.classList.add("hidden");
                    succes.textContent = "";
                }, 1500);
            } else {
                errorDisplay("TripForm", responseData.message);
            }
        } catch (error) {
            alert(`Une erreur est survenue. : ${error.message}`);
        }
    } else {
        errorDisplay("form", "euillez remplir tous les champs.");
    }
});
