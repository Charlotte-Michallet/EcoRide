import {
    escapeHtml,
    errorDisplay,
    apiCityFail,
} from "../../global/formValidator.js";

import { show } from "../../global/tripDisplay.js";

const formItineray = document.getElementById("formItineray");
const inputs = document.querySelectorAll("input");

const API_ENDPOINT = "index.php?controller=api&resource=search&action=search";

let departCity, arrivalCity, numPlaces, dateDeparture;
let lastSearchedCity = "";
let token = tokenItineray.value;

// foreach input call function
inputs.forEach((input) => {
    input.addEventListener("input", (e) => {
        switch (e.target.id) {
            case "departureItineray":
                departureCityCheck(e.target.value);
                break;

            case "arrivalItineray":
                arrivalCityCheck(e.target.value);
                break;

            case "departureDateItineray":
                dateTripCheck(e.target.value);
                break;

            case "numPassengersItineray":
                numPlacesCheck(e.target.value);
                break;

            default:
                null;
                break;
        }
    });
});

// Verify data from inputs
//verify departure city
const departureCityCheck = async (value) => {
    const cityFound = document.getElementById("cityDepFound");

    if (value.length === 0) {
        errorDisplay("depatureCity", "Veillez renseigné la ville");
        apiCityFail(cityFound);
        lastSearchedCity = "";
        departCity = null;
        return;
    } else if (
        !value.match(/^[A-Za-z0-9,'’\-\sàâäéèêëçîïôöùûüÉÀÈÙÇÎÏÔÖÛÜ]+$/i)
    ) {
        errorDisplay(
            "depatureCity",
            "La ville ne doit pas contenir de caractère spéciaux."
        );
        apiCityFail(cityFound);
        departCity = null;
        return;
    } else {
        errorDisplay("depatureCity", "", true);
        lastSearchedCity = value;
        const departCitySanitized = escapeHtml(value);
        const cityData = await debouncedApiCity(
            departCitySanitized,
            "depatureCity",
            "cityDep"
        );
        if (cityData) {
            departCity = cityData;
        } else {
            departCity = null;
        }
        if (value !== lastSearchedCity) {
            apiCityFail(cityFound);
            return;
        }
    }
};

const arrivalCityCheck = async (value) => {
    const cityFound = document.getElementById("cityArrFound");

    if (value.length === 0) {
        errorDisplay("arrivalCity", "Veillez renseigné la ville");
        apiCityFail(cityFound);
        lastSearchedCity = "";
        arrivalCity = null;
        return;
    } else if (
        !value.match(/^[A-Za-z0-9,'’\-\sàâäéèêëçîïôöùûüÉÀÈÙÇÎÏÔÖÛÜ]+$/i)
    ) {
        errorDisplay(
            "arrivalCity",
            "La ville ne doit pas contenir de caractère spéciaux."
        );
        apiCityFail(cityFound);
        arrivalCity = null;
        return;
    } else {
        errorDisplay("arrivalCity", "", true);
        lastSearchedCity = value;
        const arrivalCitySanitized = escapeHtml(value);

        const cityData = await debouncedApiCity(
            arrivalCitySanitized,
            "arrivalCity",
            "cityArr"
        );

        if (value !== lastSearchedCity) {
            apiCityFail(cityFound);
            return;
        }

        if (cityData) {
            arrivalCity = cityData;
        } else {
            arrivalCity = null;
        }
    }
};

const dateTripCheck = (value) => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    let dateTrip = new Date(value);
    dateTrip.setHours(0, 0, 0, 0);

    if (dateTrip < today) {
        errorDisplay(
            "date",
            "Veillez mettre une date superieur ou egal a aujourd'hui."
        );
        dateDeparture = null;
    } else {
        errorDisplay("date", "", true);
        dateDeparture = value;
    }
};

const numPlacesCheck = (value) => {
    if (isNaN(value)) {
        errorDisplay("numPlaces", "Ce champs doit contenir que des chiffre");
        numPlaces = null;
    } else if (value.length === 0) {
        errorDisplay("numPlaces", "Le champs doit etre renseigne");
        numPlaces = null;
    } else if (value < 1 || value > 8) {
        errorDisplay("numPlaces", "Le nombre de place doit etre entre 1 et 8");
        numPlaces = null;
    } else {
        errorDisplay("numPlaces", "", true);
        numPlaces = value;
    }
};

const checkForm = (
    departCity,
    arrivalCity,
    dateDeparture,
    numPlaces,
    token
) => {
    const dateDepartureSanitized = escapeHtml(dateDeparture);
    const numPlacesSanitized = escapeHtml(numPlaces);

    const data = {
        departCity,
        arrivalCity,
        dateDeparture: dateDepartureSanitized,
        numPlaces: numPlacesSanitized,
        token,
    };
    return data;
};

// debonce
function debounce(func, delay) {
    let timeoutId;

    // func event listner
    return function (...args) {
        clearTimeout(timeoutId);

        // new timer and return promise
        return new Promise((resolve, rejet) => {
            timeoutId = setTimeout(async () => {
                try {
                    const result = func.apply(this, args);
                    resolve(result);
                } catch (error) {
                    rejet(error);
                }
            }, delay);
        });
    };
}

const apiCity = async (city, paragraphe, para) => {
    const citysFound = document.getElementById(para + "Found");
    const encodeCity = encodeURIComponent(city);
    const API_CITY_FRANCE = `https://nominatim.openstreetmap.org/search?q=${encodeCity}&countrycodes=fr&format=json`;

    if (!city) {
        errorDisplay(paragraphe, `Veillez renseigner la ville`);
        apiCityFail(citysFound);
        return null;
    }

    try {
        const resp = await fetch(API_CITY_FRANCE);

        if (!resp.ok) {
            if (resp.status === 404) {
                errorDisplay(paragraphe, `${city} n'a pas été trouvée.`);
                apiCityFail(citysFound);
                return null;
            } else {
                throw new Error(`Erreur ${resp.status} : ${resp.statusText}.`);
            }
        }

        const data = await resp.json();

        if (data && data.length > 0) {
            let displayName = data[0].display_name;
            const parts = displayName.split(", ");
            const partsArr = [];
            for (const part of parts) {
                if (part === "France métropolitaine") {
                    break;
                }
                partsArr.push(part);
            }
            const city = partsArr.join(", ");

            citysFound.classList.remove("hidden");
            citysFound.textContent = city;

            return data[0];
        } else {
            errorDisplay(paragraphe, `${city} n'a pas été trouvée en france.`);
            apiCityFail(citysFound);
            return null;
        }
    } catch (error) {
        alert(`${error.message}`);
    }
};

const debouncedApiCity = debounce(apiCity, 1000);

// submit form
formItineray.addEventListener("submit", async (e) => {
    e.preventDefault();

    // if all variables are true (not null)
    if (departCity && arrivalCity && dateDeparture && numPlaces) {
        errorDisplay("form", "", true);

        let ItineryData = checkForm(
            departCity,
            arrivalCity,
            dateDeparture,
            numPlaces,
            token
        );

        try {
            // API
            const resp = await fetch(API_ENDPOINT, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(ItineryData),
            });
            const responseData = await resp.json();
            if (resp.ok) {
                let trips = responseData.trips;
                let seats = ItineryData.numPlaces;
                show(trips, seats);
            } else {
                errorDisplay("form", responseData.message);
                tripResults.textContent = "";
            }
        } catch (error) {
            alert(`Un probleme est survenue : ${error.message}`);
        }
    } else {
        errorDisplay("form", "Veillez remplir tout les champs.");
    }
});
