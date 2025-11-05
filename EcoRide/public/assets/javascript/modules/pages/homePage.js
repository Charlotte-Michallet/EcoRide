import {
    searchBarHome,
    numPlacesCheck,
    dateTripCheck,
    arrivalCityCheck,
    departureCityCheck,
} from "../../global/searchBar.js";

const formhome = document.getElementById("formHome");
const inputs = document.querySelectorAll("input");
const tokenHome = document.getElementById("tokenHome");

const numPlaces = document.getElementById("numPlacesError");
const date = document.getElementById("dateError");
const arrivalCity = document.getElementById("arrivalCityError");
const departureCity = document.getElementById("departureCityError");
const cityArrFound = document.getElementById("cityArrFound");
const cityFound = document.getElementById("cityDepFound");
const form = document.getElementById("formError");

// foreach input call function
inputs.forEach((input) => {
    input.addEventListener("input", (e) => {
        switch (e.target.id) {
            case "departureHome":
                departureCityCheck(e.target.value, "departureCity", cityFound);
                break;

            case "arrivalHome":
                arrivalCityCheck(e.target.value, "arrivalCity", cityArrFound);
                break;

            case "departureDateHome":
                dateTripCheck(e.target.value, "date");
                break;

            case "numPassengers":
                numPlacesCheck(e.target.value, "numPlaces");
                break;

            default:
                break;
        }
    });
});

// submit form
formhome.addEventListener("submit", async (e) => {
    e.preventDefault();
    let token = tokenHome.value;
    searchBarHome(token);
});
