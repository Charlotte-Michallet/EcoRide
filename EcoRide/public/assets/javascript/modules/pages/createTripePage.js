import {
    escapeHtml,
    errorDisplay,
    apiCityFail,
} from "./../../global/formValidator.js";

const API_ENDPOINT = "index.php?controller=api&resource=trip&action=createTrip";

let start = [];
let end = [];
let currentRoute = null;
let startMarker = null;
let endMarker = null;
let lastSearchedCity = "";
let departCity,
    arrivalCity,
    numPlaces,
    dateDeparture,
    hourDeparture,
    pricePlaces,
    kilometers,
    hour,
    minites,
    travelTime,
    carId;

const map = L.map("mapid").setView([48.8566, 2.3522], 13);
const travelInfo = document.getElementById("travelInfo");
const form = document.querySelector("form");
const inputs = document.querySelectorAll("input");
const selectchooseCar = document.getElementById("chooseCar");
const tokenTrip = document.getElementById("tokenTrip");
const calcperson = document.getElementById("calcperson");

let token = tokenTrip.value;

// foreach input call function
inputs.forEach((input) => {
    input.addEventListener("input", (e) => {
        switch (e.target.id) {
            case "departureCity":
                departureCityCheck(e.target.value);
                break;

            case "arrivalCity":
                arrivalCityCheck(e.target.value);
                break;

            case "numPlaces":
                numPlacesCheck(e.target.value);
                break;

            case "dateDeparture":
                dateTripCheck(e.target.value);
                break;

            case "hourDeparture":
                hourDepartureCheck(e.target.value);
                break;

            case "priceTrip":
                priceTripCheck(e.target.value);
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
    const cityFound = document.getElementById("cityFound");

    if (value.length === 0) {
        errorDisplay("depatureCity", "Veillez renseigné la ville");
        apiCityFail(cityFound);
        lastSearchedCity = "";
        departCity = null;
        restItinary();
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
            "city"
        );

        if (value !== lastSearchedCity) {
            apiCityFail(cityFound);
            return;
        }

        if (cityData) {
            departCity = cityData;
            start = [cityData.lon, cityData.lat];

            if (start.length && end.length) {
                showItinerary();
            }
        } else {
            departCity = null;
        }
    }
};

const arrivalCityCheck = async (value) => {
    const cityFound = document.getElementById("CitFound");

    if (value.length === 0) {
        errorDisplay("arrivalCity", "Veillez renseigné la ville");
        apiCityFail(cityFound);
        lastSearchedCity = "";
        arrivalCity = null;
        restItinary();
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
            "Cit"
        );

        if (value !== lastSearchedCity) {
            apiCityFail(cityFound);
            return;
        }

        if (cityData) {
            arrivalCity = cityData;
            end = [cityData.lon, cityData.lat];
            if (start.length && end.length) {
                showItinerary();
            }
        } else {
            arrivalCity = null;
        }
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

const hourDepartureCheck = (value) => {
    if (!value.match(/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/)) {
        errorDisplay(
            "hourDeparture",
            "Le format de l'heure est incorrect (doit être HH:mm)."
        );
        hourDeparture = null;
    } else if (value.length === 0) {
        errorDisplay("hourDeparture", "Le champs doit etre renseigné");
        hourDeparture = null;
    } else {
        errorDisplay("hourDeparture", "", true);
        hourDeparture = value;
    }
};

// verify price
const priceTripCheck = (value) => {
    let price = parseFloat(value);

    if (isNaN(price) || !Number.isInteger(price)) {
        errorDisplay("prices", "Veuillez entrer un nombre entier valide.");
        pricePlaces = null;
    } else if (price.length === 0) {
        errorDisplay("prices", "Veuillez renseigner un prix.");
        pricePlaces = null;
    } else if (price < 0) {
        errorDisplay("prices", "Le prix doit être supérieur à zéro.");
        pricePlaces = null;
    } else {
        errorDisplay("prices", "", true);
        pricePlaces = price;
    }
};

// verify car
selectchooseCar.addEventListener("change", (e) => {
    let choosecar = e.target.value;
    if (choosecar === "choose") {
        errorDisplay("TripForm", "Veillez choisir une voiture");
        carId = null;
    } else if (!choosecar.match(/^[0-9]+$/)) {
        errorDisplay("TripForm", "La valeur doit etre un nombre");
        carId = null;
    } else {
        carId = choosecar;
        errorDisplay("TripForm", "", true);
    }
});

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

const restItinary = () => {
    if (currentRoute) {
        map.removeLayer(currentRoute);
        currentRoute = null;
    }
    if (startMarker) {
        map.removeLayer(startMarker);
        startMarker = null;
    }
    if (endMarker) {
        map.removeLayer(endMarker);
        endMarker = null;
    }

    if (travelInfo) {
        travelInfo.textContent = "Distance : --km - Durée : --h --min";
    }
};

const calcPricePeson = (distanceKm) => {
    const crediKm = Math.floor(distanceKm) * 0.1;
    calcperson.textContent = `~0,10 Crédits/km par personne. ${Math.floor(
        crediKm
    )} Crédits par personnes. *Prix approximatif.`;
};

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
            citysFound.classList.remove("hidden");
            citysFound.textContent = data[0].display_name;

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
// MAP AND ITINERAIRE
// MAP
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors",
}).addTo(map);

// ITINERAIRE
async function showItinerary() {
    if (!start.length || !end.length) {
        return;
    }

    try {
        const resp = await fetch(
            `https://api.openrouteservice.org/v2/directions/driving-car?api_key=eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6IjZiZmRiZmQ0YmY0NDQ2MDBiMjU2YzM0ZDQ4NDk2ZThjIiwiaCI6Im11cm11cjY0In0=&start=${start.join(
                ","
            )}&end=${end.join(",")}`
        );

        const data = await resp.json();

        const distance = data.features[0].properties.segments[0].distance;
        const duration = data.features[0].properties.segments[0].duration;

        const coords = data.features[0].geometry.coordinates;
        const latlngs = coords.map(([lon, lat]) => [lat, lon]);

        const distanceKm = (distance / 1000).toFixed(2);
        const durationMin = Math.floor(duration / 60);
        const hoursTips = Math.floor(durationMin / 60);
        const minutesTrip = durationMin % 60;
        kilometers = distanceKm;
        hour = hoursTips;
        minites = minutesTrip;
        travelTime = hour + ":" + minites;
        if (distanceKm) {
            calcPricePeson(distanceKm);
        }

        travelInfo.textContent = `Distance : ${distanceKm}km - Durée : ${hoursTips}h ${minutesTrip}min`;

        if (currentRoute) {
            map.removeLayer(currentRoute);
        }

        currentRoute = L.polyline(latlngs, { color: "blue" }).addTo(map);

        map.fitBounds(currentRoute.getBounds());

        startMarker = L.marker([start[1], start[0]])
            .addTo(map)
            .bindPopup("Départ")
            .openPopup();
        endMarker = L.marker([end[1], end[0]]).addTo(map).bindPopup("Arrivée");
        return kilometers, hour, minites, travelTime;
    } catch (error) {
        alert(`La creation du trajet: ${error}`);
    }
}

// Check and sanitiez data from form
const checkForm = (
    departCity,
    arrivalCity,
    numPlaces,
    dateDeparture,
    hourDeparture,
    pricePlaces,
    carId,
    kilometers,
    hour,
    minites,
    travelTime,
    token
) => {
    const numPlacesSanitized = escapeHtml(numPlaces);
    const dateDepartureSanitized = escapeHtml(dateDeparture);
    const hourDepartureSanitized = escapeHtml(hourDeparture);
    const pricePlacesSanitized = escapeHtml(pricePlaces);
    const carIdPlacesSanitized = escapeHtml(carId);

    const data = {
        departCity,
        arrivalCity,
        numPlaces: numPlacesSanitized,
        dateDeparture: dateDepartureSanitized,
        hourDeparture: hourDepartureSanitized,
        pricePlaces: pricePlacesSanitized,
        carId: carIdPlacesSanitized,
        kilometers,
        hour,
        minites,
        travelTime,
        token,
    };
    return data;
};

// submit form
form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // if all variables are true (not null)
    if (
        departCity &&
        arrivalCity &&
        numPlaces &&
        dateDeparture &&
        hourDeparture &&
        pricePlaces &&
        carId &&
        kilometers &&
        hour &&
        minites &&
        travelTime
    ) {
        errorDisplay("TripForm", "", true);

        let tripData = checkForm(
            departCity,
            arrivalCity,
            numPlaces,
            dateDeparture,
            hourDeparture,
            pricePlaces,
            carId,
            kilometers,
            hour,
            minites,
            travelTime,
            token
        );

        try {
            // API
            const resp = await fetch(API_ENDPOINT, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(tripData),
            });

            const responseData = await resp.json();
            const succes = document.getElementById("succes");

            if (resp.ok) {
                setTimeout(() => {
                    succes.classList.remove("hidden");
                    succes.textContent = `La modification a bien était prise en compte.`;
                    window.location.href =
                        "/index.php?controller=auth&action=profil";

                    succes.classList.add("hidden");
                    succes.textContent = "";
                }, 1000);
            } else {
                errorDisplay("TripForm", responseData.message);
            }
        } catch (error) {
            alert(`La creation du trajet a échoué : ${error.message}`);
        }
    } else {
        errorDisplay("TripForm", "Veillez remplir tout les champs.");
    }
});
