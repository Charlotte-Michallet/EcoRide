import { escapeHtml, errorDisplay } from "./../../global/formValidator.js";

const API_ENDPOINT = "index.php?controller=api&resource=auth&action=register";
const form = document.querySelector("form");
const inputs = document.querySelectorAll("input");
const tokenRegister = document.getElementById("tokenRegister");
const selectRadio = document.querySelectorAll(
    "input[name='userRolesRegister']"
);

let role, username, email, password, pwdVerify;
let dob = null;

let token = tokenRegister.value;

// Visibility of password and verify
toggleVisibility.addEventListener("click", () => {
    if (pwdRegister.type === "password") {
        pwdRegister.type = "text";
    } else {
        pwdRegister.type = "password";
    }
});

toggleV.addEventListener("click", () => {
    if (ConfPwdR.type === "password") {
        ConfPwdR.type = "text";
    } else {
        ConfPwdR.type = "password";
    }
});

// foreach input call function
inputs.forEach((input) => {
    input.addEventListener("input", (e) => {
        switch (e.target.id) {
            case "usernameRegister":
                usernamecheck(e.target.value);
                break;

            case "emailRegister":
                emailcheck(e.target.value);
                break;

            case "dateBirthR":
                dobCheck(e.target.value);
                break;

            case "pwdRegister":
                passwordCheck(e.target.value);
                break;

            case "ConfPwdR":
                passwordmatch(e.target.value);
                break;

            default:
                break;
        }
    });
});

// verify role input
selectRadio.forEach((radio) => {
    radio.addEventListener("input", (e) => {
        let roleValue = e.target.value;

        if (!roleValue) {
            errorDisplay("registerForm", "Veuillez choisir un rôle");
            role = null;
        } else {
            role = roleValue;
            errorDisplay("registerForm", "", true);
        }
    });
});

//verify username
const usernamecheck = (value) => {
    if (value.length > 0 && (value.length < 3 || value.length > 20)) {
        errorDisplay(
            "username",
            "Le nom d’utilisateur doit comporter entre 3 et 20 caractères."
        );
        username = null;
    } else if (!value.match(/^[a-zA-Z0-9_.-]*$/)) {
        errorDisplay(
            "username",
            "Le nom d’utilisateur ne doit pas contenir de caractères spéciaux."
        );
        username = null;
    } else {
        errorDisplay("username", "", true);
        username = value;
    }
};

//verify email
const emailcheck = (value) => {
    // verify if email format is correct
    if (
        !value.match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        )
    ) {
        errorDisplay("email", "L’adresse e-mail n’est pas valide.");
        email = null;
    } else {
        errorDisplay("email", "", true);
        // initiat variable email from the form
        email = value;
    }
};

// verify date of birth (under 18)
const dobCheck = (value) => {
    const dateob = new Date(value);
    const today = new Date();

    today.setFullYear(today.getFullYear() - 18);

    if (dateob > today) {
        errorDisplay(
            "dob",
            "Vous devez être majeur pour vous inscrire sur notre site."
        );
        dob = null;
    } else {
        errorDisplay("dob", "", true);
        dob = value;
    }
};

//verify password
const passwordCheck = (value) => {
    if (
        !value.match(
            /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/
        )
    ) {
        errorDisplay(
            "pwd",
            "Le mot de passe doit comporter au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial."
        );
        password = null;
    } else {
        errorDisplay("pwd", "", true);
        password = value;
    }

    if (pwdVerify) {
        passwordmatch(pwdVerify);
    }
};

// verify password match
const passwordmatch = (value) => {
    // verify if email format is correct
    if (value !== password) {
        errorDisplay("registerForm", "Le mot de passe ne correspond pas.");
        pwdVerify = null;
    } else {
        errorDisplay("registerForm", "", true);
        pwdVerify = value;
    }
};

const checkForm = (role, username, email, dob, password, pwdVerify, token) => {
    const usernameSanitized = escapeHtml(username);
    const emailSanitized = escapeHtml(email);
    const dobSanitized = escapeHtml(dob);
    const pwdSanitized = escapeHtml(password);
    const pwdVerifySanitized = escapeHtml(pwdVerify);

    const data = {
        role,
        username: usernameSanitized,
        email: emailSanitized,
        dob: dobSanitized,
        password: pwdSanitized,
        pwdVerify: pwdVerifySanitized,
        token,
    };
    return data;
};

// submit form
form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // if all variables are true (not null)
    if (role && username && email && dob && password && pwdVerify) {
        errorDisplay("registerForm", "", true);

        let registerData = checkForm(
            role,
            username,
            email,
            dob,
            password,
            pwdVerify,
            token
        );

        try {
            // API
            const resp = await fetch(API_ENDPOINT, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(registerData),
            });

            const responseData = await resp.json();

            if (resp.status == 401) {
                errorDisplay(
                    "registerForm",
                    responseData.message ||
                        "Le nom d’utilisateur ou l'adresse e-mail exist déjà."
                );
            } else if (resp.ok) {
                window.location.href = "/index.php";
            } else {
                errorDisplay(
                    "registerForm",
                    responseData.message || "L'inscription a échoué."
                );
            }
        } catch (error) {
            alert(`Inscription échouée : ${error.message}`);
        }
    } else {
        errorDisplay("registerForm", "Veuillez remplir tous les champs.");
    }
});
