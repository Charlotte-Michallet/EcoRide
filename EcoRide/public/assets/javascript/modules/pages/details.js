const API_ENDPOINT =
    "index.php?controller=api&resource=search&action=participate";

const modal = document.getElementById("modal");
const cancel = document.getElementById("cancel");
const participateBtn = document.getElementById("participateBtn");

const errorLoggin = document.getElementById("errorLoggin");
const credits = document.getElementById("credits");
let creditsData = credits.textContent;

participate.addEventListener("click", async () => {
    try {
        let creditsObjet = {
            credits: creditsData,
        };

        // API
        // fetch api entry point
        const resp = await fetch(API_ENDPOINT, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(creditsObjet),
        });
        await resp.json();

        if (resp.ok) {
            modal.classList.remove("hidden");
        } else if (resp.status == 402) {
            errorLoggin.classList.remove("hidden");
            errorLoggin.textContent = "Vous avez pas assez de credit";

            setTimeout(() => {
                window.location.href =
                    "http://localhost:8080/index.php?controller=auth&action=credits";
            }, 1800);
        } else if (resp.status == 403) {
            errorLoggin.classList.remove("hidden");
            errorLoggin.textContent =
                "Vous devez etre passager ou conducteur et passager";

            setTimeout(() => {
                window.location.href =
                    "http://localhost:8080/index.php?controller=auth&action=profil";
            }, 1800);
        } else {
            errorLoggin.classList.remove("hidden");
            errorLoggin.textContent =
                "Veilleiz vous connecter ou creer un compte d'abord";
            setTimeout(() => {
                window.location.href =
                    "http://localhost:8080/index.php?controller=auth&action=login";
            }, 1500);
        }
    } catch (error) {
        alert(`une erreur est survenue : ${error.message}`);
    }
});

cancel.addEventListener("click", () => {
    modal.classList.add("hidden");
});
