import { escapeHtml, errorDisplay } from "./../../global/formValidator.js";

const API_ENDPOINT =
    "index.php?controller=api&resource=profil&action=modifyProfil";
const IMG_API_ENDPOINT = "index.php?controller=api&resource=profil&action=img";

const forms = document.querySelectorAll("form");
const inputs = document.querySelectorAll("input");

const selectRoles = document.querySelectorAll("input[name='userRoles']");

const selectAniamls = document.querySelectorAll("input[name='animalsAllowed']");
const selectSmocking = document.querySelectorAll(
    "input[name='allowedSmoking']"
);
const textPref = document.getElementById("otherPreferences");

let data, token;
let role, username, email, photo, password, pwdVerify;
let animal, smoking, preferences;

// Visibility of password and verify
toggleVisibility.addEventListener("click", () => {
    if (passwordModif.type === "password") {
        passwordModif.type = "text";
    } else {
        passwordModif.type = "password";
    }
});

toggleV.addEventListener("click", () => {
    if (ConfPwd.type === "password") {
        ConfPwd.type = "text";
    } else {
        ConfPwd.type = "password";
    }
});

// foreach input call function verify
inputs.forEach((input) => {
    input.addEventListener("input", (e) => {
        switch (e.target.id) {
            case "username":
                usernamecheck(e.target.value);
                break;

            case "email":
                emailcheck(e.target.value);
                break;

            case "photo":
                photoCheck(e.target.files[0]);
                break;

            case "passwordModif":
                passwordCheck(e.target.value);
                break;

            case "ConfPwd":
                passwordmatch(e.target.value);
                break;

            default:
                null;
                break;
        }
    });
});
// CHECK INPUTS

// verify role input
selectRoles.forEach((radio) => {
    radio.addEventListener("input", (e) => {
        let roleValue = e.target.value;

        if (!roleValue) {
            errorDisplay("roles", "Veuillez choisir un rôle");
            role = null;
        } else {
            role = roleValue;
            errorDisplay("roles", "", true);
        }
    });
});

// check username
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
    if (value.length === 0) {
        errorDisplay("email", "", true);
        email = "";
    } else if (!value.match(/^[\w_-]+@[\w-]+\.[a-z]{2,4}$/i)) {
        errorDisplay("email", "L’adresse e-mail n’est pas valide.");
        email = null;
    } else {
        errorDisplay("email", "", true);
        // initiat variable email from the form
        email = value;
    }
};

const photoCheck = (files) => {
    const mimeAutorised = ["image/png", "image/jpeg", "image/jpg"];

    const reader = new FileReader();
    const maxSize = 3 * 1024 * 1024;

    if (files && files.type) {
        if (mimeAutorised.includes(files.type)) {
            if (files.size < maxSize) {
                photo = files;
                const prevue = document.getElementById("prevue");
                reader.onload = function (e) {
                    prevue.src = e.target.result;
                };
                reader.readAsDataURL(files);
            } else {
                errorDisplay(
                    "photo",
                    "La taille de l'image ne doit pas dépasser 3Mo"
                );
                photo = null;
            }
        } else {
            errorDisplay(
                "photo",
                "Veuillez sélectionner une image au format png, jepg ou jpg"
            );
            photo = null;
        }
    } else {
        errorDisplay("photo", "Veuillez sélectionner une image.");
        photo = null;
    }
};

// PASSWORD
//verify password
const passwordCheck = (value) => {
    if (
        !value.match(
            /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/
        )
    ) {
        errorDisplay(
            "password",
            "Le mot de passe doit avoir au moins 8 caractère, une majuscule, une minuscule, un chiffre et un caracteres special."
        );
        password = null;
    } else {
        errorDisplay("password", "", true);
        password = value;
    }

    if (pwdVerify) {
        passwordmatch(pwdVerify);
    }
};

// verify password match
const passwordmatch = (value) => {
    if (value !== password) {
        errorDisplay("Form", "Le mot de passe ne correspond pas.");
        pwdVerify = null;
    } else {
        errorDisplay("Form", "", true);
        pwdVerify = value;
    }
};

// verify annimal input
selectAniamls.forEach((radio) => {
    radio.addEventListener("input", (e) => {
        let acceptValue = e.target.value;

        if (!acceptValue) {
            errorDisplay("preferences", "Veuillez choisir une préférence.");
            animal = null;
        } else {
            animal = acceptValue;
            errorDisplay("preferences", "", true);
        }
    });
});

// verify smocking input
selectSmocking.forEach((radio) => {
    radio.addEventListener("input", (e) => {
        let acceptValue = e.target.value;

        if (!acceptValue) {
            errorDisplay("preferences", "Veuillez choisir une préférence.");
            smoking = null;
        } else {
            smoking = acceptValue;
            errorDisplay("preferences", "", true);
        }
    });
});

textPref.addEventListener("input", (e) => {
    let value = e.target.value;

    if (value.length === 0) {
        errorDisplay("otherPreferences", "Le champ ne doit pas être vide.");
        preferences = null;
    } else if (!value.match(/^[a-zA-Z0-9\s\-.&+\/()[\]!,;:\é\è\à\ç\ù]+$/)) {
        errorDisplay(
            "otherPreferences",
            "Le champ ne doit pas contenir de caractères spéciaux."
        );
        preferences = null;
    } else {
        errorDisplay("otherPreferences", "", true);
        preferences = value;
    }
});

// FORMS
// foreach form call function check data and api(send data)
forms.forEach((form) => {
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        switch (e.target.id) {
            case "formRoles":
                data = checkFormRoles(role, token);
                if (role) {
                    errorDisplay("roles", "", true);
                    API(data, "roles");
                } else {
                    errorDisplay("roles", "Veuillez choisir un rôle");
                }
                break;

            case "formUsername":
                data = checkFormUser(username, token);

                if (username) {
                    errorDisplay("username", "", true);
                    API(data, "username", "Le nom d’utilisateur exist déjà.");
                } else {
                    errorDisplay(
                        "username",
                        "Veuillez remplir le champs nom d’utilisateur."
                    );
                }
                break;

            case "formEmail":
                data = checkFormEmail(email, token);

                if (email) {
                    errorDisplay("email", "", true);
                    API(data, "email", "L'adresse mail exist déjà.");
                } else {
                    errorDisplay("email", "Veuillez remplir le champs email.");
                }
                break;

            case "formPhoto":
                if (photo) {
                    token = tokenPhoto.value;
                    imgAPI(photo, token, "photo");

                    errorDisplay("photo", "", true);
                } else {
                    errorDisplay("photo", "Veuillez sélectionner une image.");
                }
                break;

            case "formpassword":
                data = checkFormPwd(password, pwdVerify, token);

                if (password && pwdVerify) {
                    errorDisplay("Form", "", true);
                    API(data, "Form");
                } else {
                    errorDisplay("Form", "Veuillez remplir les mot de passe.");
                }
                break;

            case "formPreferences":
                data = checkFormAccept(animal, smoking, token);

                if (animal && smoking) {
                    errorDisplay("preferences", "", true);
                    API(data, "preferences");
                } else {
                    errorDisplay(
                        "preferences",
                        "Veuillez choisir vos préferences."
                    );
                }
                break;

            case "formotherPreferences":
                data = checkFormpreferences(preferences, token);

                if (preferences) {
                    errorDisplay("otherPreferences", "", true);
                    API(data, "otherPreferences");
                } else {
                    errorDisplay(
                        "otherPreferences",
                        "Veuillez remplir ce champ."
                    );
                }
                break;

            default:
                null;
                break;
        }
    });
});

// CHECK DATA
// check roles
const checkFormRoles = (role, token) => {
    // if empty dont send
    token = tokenrole.value;
    const roleSanitized = escapeHtml(role);
    const data = {
        role: roleSanitized,
        token,
    };
    return data;
};

const checkFormUser = (username, token) => {
    // if empty dont send
    token = tokenUser.value;

    const usernameSanitized = escapeHtml(username);

    const data = {
        username: usernameSanitized,
        token,
    };
    return data;
};

const checkFormEmail = (email, token) => {
    // if empty dont send
    token = tokenEmail.value;
    const emailSanitized = escapeHtml(email);

    const data = {
        email: emailSanitized,
        token,
    };
    return data;
};

const checkFormPwd = (password, pwdVerify, token) => {
    // if empty dont send
    token = tokenPwd.value;
    const passwordSanitized = escapeHtml(password);
    const pwdVerifySanitized = escapeHtml(pwdVerify);

    const data = {
        password: passwordSanitized,
        pwdVerify: pwdVerifySanitized,
        token,
    };
    return data;
};

const checkFormAccept = (animal, smoking, token) => {
    // if empty dont send
    token = tokenPreferences.value;
    const animalSanitized = escapeHtml(animal);
    const smokingSanitized = escapeHtml(smoking);
    const data = {
        animal: animalSanitized,
        smoking: smokingSanitized,
        token,
    };
    return data;
};

const checkFormpreferences = (preferences, token) => {
    // if empty dont send
    token = tokenpreference.value;
    const preferencesSanitized = escapeHtml(preferences);

    const data = {
        preferences: preferencesSanitized,
        token,
    };
    return data;
};

// API
const API = async (data, error, message = "") => {
    try {
        const resp = await fetch(API_ENDPOINT, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data),
        });

        const responseData = await resp.json();

        if (resp.ok) {
            const succes = document.getElementById("succes");
            succes.classList.remove("hidden");
            succes.textContent = `La modification a bien été prise en compte.`;

            setTimeout(() => {
                window.location.href =
                    "/index.php?controller=auth&action=profil";

                succes.classList.add("hidden");
                succes.textContent = "";
            }, 1000);
        } else {
            errorDisplay(
                error,
                responseData.message ||
                    `La modification n'a pas été prise en compte. ${message}`
            );
        }
    } catch (error) {
        alert(
            `Les modifications n'ont pas été prises en compte : ${error.message}`
        );
    }
};

const imgAPI = async (photofile, token, error, message = "") => {
    const formData = new FormData();

    formData.append("image", photofile);
    formData.append("token", token);

    try {
        const resp = await fetch(IMG_API_ENDPOINT, {
            method: "POST",
            body: formData,
        });

        const responseData = await resp.json();

        if (resp.ok) {
            const succes = document.getElementById("succes");
            succes.classList.remove("hidden");
            succes.textContent = `La modification a bien été prise en compte.`;

            setTimeout(() => {
                window.location.href =
                    "/index.php?controller=auth&action=profil";

                succes.classList.add("hidden");
                succes.textContent = "";
            }, 1000);
        } else {
            errorDisplay(
                error,
                responseData.message ||
                    `La modification n'a pas été prise en compte. ${message}`
            );
        }
    } catch (error) {
        alert(
            `Les modifications n'ont pas été prises en compte : ${error.message}`
        );
    }
};
