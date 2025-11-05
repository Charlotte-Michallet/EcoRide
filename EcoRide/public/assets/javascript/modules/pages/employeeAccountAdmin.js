import { escapeHtml, errorDisplay } from "./../../global/formValidator.js";

const API_ENDPOINT = "index.php?controller=api&resource=auth&action=register";
const modalopen = document.getElementById("modal");
const employeeModal = document.getElementById("employeeModal");
const employeeoverlay = document.getElementById("employeeoverlay");
const closeModal = document.getElementById("closeModal");
const inputs = document.querySelectorAll("input");
const form = document.getElementById("employeeForm");

let token = tokenCsrf.value;
let username, email, password, pwdVerify;
let dob = null;
let role = "employee";

modalopen.addEventListener("click", () => {
    employeeModal.classList.remove("hidden");
    employeeoverlay.classList.remove("hidden");
});

closeModal.addEventListener("click", () => {
    employeeModal.classList.add("hidden");
    employeeoverlay.classList.add("hidden");
});

// Visibility of password and verify
toggleVisibility.addEventListener("click", () => {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
});

toggleV.addEventListener("click", () => {
    if (ConfPwdR.type === "password") {
        ConfPwdR.type = "text";
    } else {
        ConfPwdR.type = "password";
    }
});

inputs.forEach((input) => {
    input.addEventListener("input", (e) => {
        switch (e.target.id) {
            case "username":
                usernamecheck(e.target.value);
                break;

            case "email":
                emailcheck(e.target.value);
                break;

            case "dateOfBirth":
                dobCheck(e.target.value);
                break;

            case "passwordInput":
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

//verify username
const usernamecheck = (value) => {
    if (value.length > 0 && (value.length < 3 || value.length > 20)) {
        errorDisplay(
            "username",
            "Le nom d’utilisateur doit contenir entre 3 et 20 caractères."
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
    if (
        !value.match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        )
    ) {
        errorDisplay("email", "L'adresse e-mail n'est pas valide.");
        email = null;
    } else {
        errorDisplay("email", "", true);
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
            "L'employé doit être majeur pour s'inscrire sur ce site."
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
            "Le mot de passe doit comporter au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial."
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
        errorDisplay("form", "Le mot de passe ne correspond pas.");
        pwdVerify = null;
    } else {
        errorDisplay("form", "", true);
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
        errorDisplay("form", "", true);

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
                    "form",
                    responseData.message ||
                        "Le nom d’utilisateur ou l'adresse e-mail existe déjà."
                );
            } else if (resp.ok) {
                window.location.href =
                    "/index.php?controller=admin&action=employees";
            } else {
                errorDisplay(
                    "form",
                    responseData.message || "Échec de l'inscription"
                );
            }
        } catch (error) {
            alert(`Inscription échouée : ${error.message}`);
        }
    } else {
        errorDisplay("form", "Veuillez remplir tous les champs.");
    }
});
