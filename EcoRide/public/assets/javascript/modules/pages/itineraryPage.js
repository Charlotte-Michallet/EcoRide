import {
    searchBar,
    numPlacesCheck,
    dateTripCheck,
    arrivalCityCheck,
    departureCityCheck,
} from "../../global/searchBar.js";

const savedData = sessionStorage.getItem("tripData");

const formItinerary = document.getElementById("formItinerary");

const inputs = document.querySelectorAll("input");
const tokenItinerary = document.getElementById("tokenItinerary");

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
            case "departureItinerary":
                departCity = await departureCityCheck(
                    e.target.value,
                    "depatureCity",
                    cityFound
                );
                break;

            case "arrivalItinerary":
                arriCity = await arrivalCityCheck(
                    e.target.value,
                    "arrivalCity",
                    cityArrFound
                );
                break;

            case "departureDateItinerary":
                dateDeparture = await dateTripCheck(e.target.value, "date");
                break;

            case "numPassengersItinerary":
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
    const ItineraryData = JSON.parse(savedData);
    let token = tokenItinerary.value;
    let departCity = ItineraryData.departCity;
    let arriCity = ItineraryData.arriCity;
    let dateDeparture = ItineraryData.dateDeparture;
    let numberPlaces = ItineraryData.numberPlaces;

    searchBar(departCity, arriCity, dateDeparture, numberPlaces, token);
    sessionStorage.removeItem("tripData");
}

// submit form
formItinerary.addEventListener("submit", (e) => {
    e.preventDefault();

    let token = tokenItinerary.value;
    searchBar(departCity, arriCity, dateDeparture, numberPlaces, token);
});
