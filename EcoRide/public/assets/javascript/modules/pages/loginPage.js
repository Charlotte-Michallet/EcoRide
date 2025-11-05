import { escapeHtml, errorDisplay } from "./../../global/formValidator.js";

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
                break;
        }
    });
});

//email validation function
const emailcheck = function (value) {
    // verify if email format is correct
    if (
        !value.match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        )
    ) {
        errorDisplay("emailLogin", "L'adresse e-mail n'est pas valide.");
        email = null;
    } else {
        errorDisplay("emailLogin", "", true);
        // initiat variable email from the form
        email = value;
    }
};

//password validation function
const passwordCheck = (value) => {
    if (
        !value.match(
            /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/
        )
    ) {
        errorDisplay(
            "pwdLogin",
            "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial."
        );
        password = null;
    } else {
        errorDisplay("pwdLogin", "", true);
        password = value;
    }
};

// check and sanitize form data
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

    // check if variables are valid
    if (email && password && token) {
        errorDisplay("formcheck", "", true);

        let loginData = checkForm(email, password, token);

        try {
            // fetch API endpoint
            const resp = await fetch(API_ENDPOINT, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(loginData),
            });

            const responseData = await resp.json();

            if (resp.ok) {
                window.location.href = "/index.php";
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
            alert(`Connexion échouée : ${error.message}`);
        }
    } else {
        errorDisplay("formcheck", "Veuillez remplir tous les champs.");
    }
});
