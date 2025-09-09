const API_ENDPOINT =
    "index.php?controller=api&resource=search&action=participate";

const modal = document.getElementById("modal");
const cancel = document.getElementById("cancel");
const participateBtn = document.getElementById("participateBtn");
const participateDetailsBtn = document.getElementById("participate");

const errorDetails = document.getElementById("errorDetails");
const credits = document.getElementById("credits");
let creditsTrip = credits.textContent;
const params = new URLSearchParams(window.location.search);
const numSeats = params.get("seats");

let creditsData = numSeats * creditsTrip;

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
        const responseData = await resp.json();

        if (resp.ok) {
            modal.classList.remove("hidden");
        } else if (resp.status == 401) {
            errorDetails.classList.remove("hidden");
            errorDetails.textContent =
                "Veuillez vous connecter ou créer un compte d'abord.";
            setTimeout(() => {
                window.location.href =
                    "/index.php?controller=auth&action=login";
            }, 1500);
        } else if (resp.status == 405) {
            errorDetails.classList.remove("hidden");
            errorDetails.textContent =
                "Vous devais etre passager ou conducteur passager";
            setTimeout(() => {
                window.location.href =
                    "/index.php?controller=auth&action=profilModify";
            }, 1500);
        } else if (resp.status == 402) {
            errorDetails.classList.remove("hidden");
            errorDetails.textContent = "Vous n’avez pas assez de crédits.";

            setTimeout(() => {
                window.location.href =
                    "/index.php?controller=auth&action=credits";
            }, 1800);
        } else {
            errorDetails.classList.remove("hidden");
            errorDetails.textContent = responseData.message;
        }
    } catch (error) {
        alert(`Une erreur est survenue : ${error.message}`);
    }
});

cancel.addEventListener("click", () => {
    modal.classList.add("hidden");
});
