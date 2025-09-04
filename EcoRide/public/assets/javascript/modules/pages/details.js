const API_ENDPOINT =
    "index.php?controller=api&resource=search&action=participate";

const modal = document.getElementById("modal");
const cancel = document.getElementById("cancel");
const participateBtn = document.getElementById("participateBtn");
const participateDetailsBtn = document.getElementById("participate");

const errorLoggin = document.getElementById("errorLoggin");
const credits = document.getElementById("credits");
let creditsData = credits.textContent;

participateDetailsBtn.addEventListener("click", async () => {
    try {
        let creditsObjet = {
            credits: creditsData,
        };

        // fetch API entry point
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
            errorLoggin.textContent = "Vous n’avez pas assez de crédits.";

            setTimeout(() => {
                window.location.href =
                    "/index.php?controller=auth&action=credits";
            }, 1800);
        } else if (resp.status == 403) {
            errorLoggin.classList.remove("hidden");
            errorLoggin.textContent =
                "Vous devez être passager, ou conducteur et passager.";

            setTimeout(() => {
                window.location.href =
                    "index.php?controller=auth&action=profil";
            }, 1800);
        } else {
            errorLoggin.classList.remove("hidden");
            errorLoggin.textContent =
                "Veuillez vous connecter ou créer un compte d'abord.";
            setTimeout(() => {
                window.location.href =
                    "/index.php?controller=auth&action=login";
            }, 1500);
        }
    } catch (error) {
        alert(`Une erreur est survenue : ${error.message}`);
    }
});

cancel.addEventListener("click", () => {
    modal.classList.add("hidden");
});
