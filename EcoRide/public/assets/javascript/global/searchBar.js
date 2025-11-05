import { escapeHtml, errorDisplay, apiCityFail } from "./formValidator.js";
import { show } from "./tripDisplay.js";

const API_ENDPOINT = "index.php?controller=api&resource=search&action=search";

let departCity, arriCity, numberPlaces, dateDeparture;
let lastSearchedCity = "";

//verify departure city
export const departureCityCheck = async (value, error, cityFound) => {
    if (value.length === 0) {
        errorDisplay(error, "Veuillez renseigner la ville");
        apiCityFail(cityFound);
        lastSearchedCity = "";
        departCity = null;
        return;
    } else if (
        !value.match(/^[A-Za-z0-9,'’\-\sàâäéèêëçîïôöùûüÉÀÈÙÇÎÏÔÖÛÜ]+$/i)
    ) {
        errorDisplay(
            error,
            "La ville ne doit pas contenir de caractères spéciaux."
        );
        apiCityFail(cityFound);
        departCity = null;
        return;
    } else {
        errorDisplay(error, "", true);
        lastSearchedCity = value;
        const departCitySanitized = escapeHtml(value);
        const cityData = await debouncedApiCity(
            departCitySanitized,
            error,
            cityFound
        );

        if (value !== lastSearchedCity) {
            apiCityFail(cityFound);
            return;
        }

        if (cityData) {
            departCity = cityData;
            return departCity;
        } else {
            departCity = null;
        }
    }
};

export const arrivalCityCheck = async (value, error, cityArrFound) => {
    if (value.length === 0) {
        errorDisplay(error, "Veuillez renseigner la ville");
        apiCityFail(cityArrFound);
        lastSearchedCity = "";
        arriCity = null;
        return;
    } else if (
        !value.match(/^[A-Za-z0-9,'’\-\sàâäéèêëçîïôöùûüÉÀÈÙÇÎÏÔÖÛÜ]+$/i)
    ) {
        errorDisplay(
            error,
            "La ville ne doit pas contenir de caractères spéciaux"
        );
        apiCityFail(cityArrFound);

        arriCity = null;
        return;
    } else {
        errorDisplay(error, "", true);
        lastSearchedCity = value;
        const arrivalCitySanitized = escapeHtml(value);
        const cityData = await debouncedApiCity(
            arrivalCitySanitized,
            error,
            cityArrFound
        );
        if (value !== lastSearchedCity) {
            apiCityFail(cityArrFound);
            return;
        }
        if (cityData) {
            arriCity = cityData;
            return arriCity;
        } else {
            arriCity = null;
        }
    }
};

export const dateTripCheck = (value, error) => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    let dateTrip = new Date(value);
    dateTrip.setHours(0, 0, 0, 0);

    if (dateTrip < today) {
        errorDisplay(
            error,
            "Veuillez mettre une date supérieure ou égale à aujourd'hui."
        );
        dateDeparture = null;
    } else {
        errorDisplay(error, "", true);
        dateDeparture = value;
        return dateDeparture;
    }
};

export const numPlacesCheck = (value, error) => {
    if (Number.isNaN(value)) {
        errorDisplay(error, "Ce champ doit contenir uniquement des chiffres.");
        numberPlaces = null;
    } else if (value.length === 0) {
        errorDisplay(error, "Le champ doit être renseigné.");
        numberPlaces = null;
    } else if (value < 1 || value > 8) {
        errorDisplay(error, "Le nombre de places doit être entre 1 et 8.");
        numberPlaces = null;
    } else {
        errorDisplay(error, "", true);
        numberPlaces = value;
        return numberPlaces;
    }
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
                    const result = await func.apply(this, args);
                    resolve(result);
                } catch (error) {
                    rejet(error);
                }
            }, delay);
        });
    };
}

const checkForm = (
    departCity,
    arriCity,
    dateDeparture,
    numberPlaces,
    token
) => {
    const dateDepartureSanitized = escapeHtml(dateDeparture);
    const numPlacesSanitized = escapeHtml(numberPlaces);

    const data = {
        departCity,
        arriCity,
        dateDeparture: dateDepartureSanitized,
        numberPlaces: numPlacesSanitized,
        token,
    };
    return data;
};

const apiTrip = async (ItineraryData) => {
    try {
        // API
        const resp = await fetch(API_ENDPOINT, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(ItineraryData),
        });
        const responseData = await resp.json();
        if (resp.ok) {
            let trips = responseData.trips;
            let seats = ItineraryData.numberPlaces;

            show(trips, seats);
        } else {
            errorDisplay("form", responseData.message);
            tripResults.textContent = "";
        }
    } catch (error) {
        alert(`Un problème est survenu : ${error.message}`);
    }
};

export function searchBar(
    departCity,
    arriCity,
    dateDeparture,
    numberPlaces,
    token
) {
    // if all variables are true (not null)
    if (departCity && arriCity && dateDeparture && numberPlaces && token) {
        errorDisplay("form", "", true);

        let ItineraryData = checkForm(
            departCity,
            arriCity,
            dateDeparture,
            numberPlaces,
            token
        );

        apiTrip(ItineraryData);
    } else {
        errorDisplay("form", "Veuillez remplir tous les champs.");
    }
}

export function searchBarHome(token) {
    // if all variables are true (not null)
    if (departCity && arriCity && dateDeparture && numberPlaces) {
        errorDisplay("form", "", true);

        let ItineraryData = {
            departCity,
            arriCity,
            dateDeparture,
            numberPlaces,
            token,
        };
        sessionStorage.setItem("tripData", JSON.stringify(ItineraryData));
        window.location.href = "/index.php?controller=car-sharing&action=show";
    } else {
        errorDisplay("form", "Veuillez remplir tous les champs.");
    }
}

const apiCity = async (city, paragraphe, citysFound) => {
    const encodeCity = encodeURIComponent(city);
    const API_CITY_FRANCE = `https://nominatim.openstreetmap.org/search?q=${encodeCity}&countrycodes=fr&format=json`;

    if (!city) {
        errorDisplay(paragraphe, `"Veuillez renseigner la ville.`);
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
            errorDisplay(paragraphe, `${city} n'a pas été trouvée en France.`);
            apiCityFail(citysFound);
            return null;
        }
    } catch (error) {
        alert(`${error.message}`);
    }
};

const debouncedApiCity = debounce(apiCity, 1000);
