import { escapeHtml } from "./../../global/formValidator.js";

const API_ENDPOINT = "index.php?controller=api&resource=auth&action=login";
const form = document.querySelector("form");
const inputs = document.querySelectorAll("input");
const tokenLogin = document.getElementById("tokenLogin");

let email, password;
let token = tokenLogin.value;

toggleVisibility.addEventListener("click", () => {
    if (pwdLogin.type === "password") {
        pwdLogin.type = "text";
    } else {
        pwdLogin.type = "password";
    }
});

// foreach input
inputs.forEach((input) => {
    input.addEventListener("input", (e) => {
        switch (e.target.id) {
            case "emailLogin":
                emailcheck(e.target.value);
                break;

            case "pwdLogin":
                passwordCheck(e.target.value);
                break;

            default:
                null;
                break;
        }
    });
});

// error paragraph with message
const errorDisplay = (tag, message, valid) => {
    const paragrapheError = document.getElementById(tag + "Error");
    if (!valid) {
        paragrapheError.classList.remove("hidden");
        paragrapheError.textContent = message;
    } else {
        paragrapheError.classList.add("hidden");
        paragrapheError.textContent = "";
    }
};

//function verification mail
const emailcheck = function (value) {
    // verify if email format is correct
    if (!value.match(/^[\w_-]+@[\w-]+\.[a-z]{2,4}$/i)) {
        errorDisplay("emailLogin", "Le mail n'est pas valid.");
        email = null;
    } else {
        errorDisplay("emailLogin", "", true);
        // initiat variable email from the form
        email = value;
    }
};

//function verification password
const passwordCheck = (value) => {
    password = value;
    if (
        !value.match(
            /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/
        )
    ) {
        errorDisplay(
            "pwdLogin",
            "Le mot de passe doit avoir au moins 8 caractère, une majuscule, une minuscule, un chiffre et un caracteres special."
        );
        password = null;
    } else {
        errorDisplay("pwdLogin", "", true);
        password = value;
    }
};

const checkForm = (email, password, token) => {
    const emailSanitized = escapeHtml(email);
    const pwdSanitized = escapeHtml(password);

    const data = {
        email: emailSanitized,
        password: pwdSanitized,
        token,
    };
    return data;
};

// submit form
form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // if variable are true
    if (email && password && token) {
        errorDisplay("formcheck", "", true);

        let loginData = checkForm(email, password, token);

        try {
            // API
            // fetch api entry point
            const resp = await fetch(API_ENDPOINT, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(loginData),
            });

            const responseData = await resp.json();

            if (resp.ok) {
                window.location.href = "http://localhost:8080/index.php";
            } else if (resp.status == 401) {
                errorDisplay(
                    "formcheck",
                    responseData.message || "Email ou mot de passe incorrect."
                );
            } else {
                errorDisplay(
                    "formcheck",
                    responseData.message ||
                        "Une erreur inattendue est survenue lors de la connexion."
                );
            }
        } catch (error) {
            alert(`Connexion echouer : ${error.message}`);
        }
    } else {
        errorDisplay("formcheck", "Veuillez remplir tous les champs.");
    }
});
