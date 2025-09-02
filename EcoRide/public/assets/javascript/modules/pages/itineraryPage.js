import {
    searchBar,
    numPlacesCheck,
    dateTripCheck,
    arrivalCityCheck,
    departureCityCheck,
} from "../../global/searchBar.js";

const savedData = sessionStorage.getItem("tripData");

const formItineray = document.getElementById("formItineray");
const inputs = document.querySelectorAll("input");
const tokenItineray = document.getElementById("tokenItineray");

const numPlaces = document.getElementById("numPlacesError");
const date = document.getElementById("dateError");
const arrivalCity = document.getElementById("arrivalCityError");
const depatureCity = document.getElementById("depatureCityError");
const cityArrFound = document.getElementById("cityArrFound");
const cityFound = document.getElementById("cityDepFound");
const form = document.getElementById("formError");
const tripResults = document.getElementById("tripResults");

let departCity, arriCity, numberPlaces, dateDeparture;

// foreach input call function
inputs.forEach((input) => {
    input.addEventListener("input", async (e) => {
        switch (e.target.id) {
            case "departureItineray":
                departCity = await departureCityCheck(
                    e.target.value,
                    "depatureCity",
                    cityFound
                );
                break;

            case "arrivalItineray":
                arriCity = await arrivalCityCheck(
                    e.target.value,
                    "arrivalCity",
                    cityArrFound
                );
                break;

            case "departureDateItineray":
                dateDeparture = await dateTripCheck(e.target.value, "date");
                break;

            case "numPassengersItineray":
                numberPlaces = await numPlacesCheck(
                    e.target.value,
                    "numPlaces"
                );
                break;

            default:
                null;
                break;
        }
    });
});

if (savedData) {
    const ItineryData = JSON.parse(savedData);
    let token = tokenItineray.value;
    let departCity = ItineryData.departCity;
    let arriCity = ItineryData.arriCity;
    let dateDeparture = ItineryData.dateDeparture;
    let numberPlaces = ItineryData.numberPlaces;

    searchBar(departCity, arriCity, dateDeparture, numberPlaces, token);
    sessionStorage.removeItem("tripData");
}

// submit form
formItineray.addEventListener("submit", (e) => {
    e.preventDefault();

    let token = tokenItineray.value;
    searchBar(departCity, arriCity, dateDeparture, numberPlaces, token);
});
