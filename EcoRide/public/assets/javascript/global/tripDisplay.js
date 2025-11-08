const API_ENDPOINT = "index.php?controller=api&resource=search&action=filter";
// filter
let originalTrip = null;
export function show(trips, seats) {
    tripResults.textContent = "";

    if (originalTrip === null) {
        originalTrip = trips;
    }

    // filter
    const filterContainer = document.createElement("div");
    filterContainer.className = "items-center w-9/10 xl:w-7/10";
    tripResults.appendChild(filterContainer);

    const errorContainer = document.createElement("div");
    errorContainer.className = "items-center w-full";
    filterContainer.appendChild(errorContainer);

    const errortext = document.createElement("p");
    errortext.className = "text-xs text-red-600 mt-2";
    errorContainer.appendChild(errortext);

    // ajouter form
    const filterForm = document.createElement("form");
    filterForm.className = "flex flex-wrap justify-between items-center w-full";
    filterContainer.appendChild(filterForm);

    const EcoContainer = document.createElement("div");
    EcoContainer.className = "lg:w-1/7 mb-2";
    filterForm.appendChild(EcoContainer);

    const EcoBtn = document.createElement("button");
    EcoBtn.className =
        "btnSearch py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white mb-2 lg:mb-0";
    EcoBtn.textContent = "Voyage écologique";
    EcoBtn.setAttribute("type", "button");
    EcoContainer.appendChild(EcoBtn);

    const starsContainer = document.createElement("div");
    starsContainer.className = "lg:w-1/7";
    filterForm.appendChild(starsContainer);

    const labelstarsNum = document.createElement("label");
    labelstarsNum.htmlFor = "starsNum";
    labelstarsNum.textContent = "Étoiles minimum";
    starsContainer.appendChild(labelstarsNum);

    const starsSelect = document.createElement("select");
    starsSelect.className =
        "block w-full px-4 py-2 mb-2 lg:mb-0 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring";
    starsSelect.name = "starsNum";
    starsSelect.id = "starsNum";
    starsContainer.appendChild(starsSelect);

    const optionDefault = document.createElement("option");
    optionDefault.textContent = "Nombre d'étoiles";
    optionDefault.value = "";
    optionDefault.selected = true;
    starsSelect.appendChild(optionDefault);

    const optionData = [
        { text: "1 étoile", value: 1 },
        { text: "2 étoiles", value: 2 },
        { text: "3 étoiles", value: 3 },
        { text: "4 étoiles", value: 4 },
        { text: "5 étoiles", value: 5 },
    ];

    optionData.forEach((data) => {
        const option = document.createElement("option");
        option.textContent = data.text;
        option.value = data.value;
        starsSelect.appendChild(option);
    });

    const priceMaxContainer = document.createElement("div");
    priceMaxContainer.className = "lg:w-1/7 mb-2 lg:mb-0";
    filterForm.appendChild(priceMaxContainer);

    const labelPricesMax = document.createElement("label");
    labelPricesMax.htmlFor = "maxPrice";
    labelPricesMax.textContent = "Prix max";
    priceMaxContainer.appendChild(labelPricesMax);

    const priceInputContainer = document.createElement("div");
    priceInputContainer.className = "flex items-center ";
    priceMaxContainer.appendChild(priceInputContainer);

    const imputPricesMax = document.createElement("input");
    imputPricesMax.type = "number";
    imputPricesMax.id = "priceMax";
    imputPricesMax.placeholder = "45 Crédits";
    imputPricesMax.setAttribute("min", "1");
    imputPricesMax.className =
        "block w-full px-4 py-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring";
    priceInputContainer.appendChild(imputPricesMax);

    const timeMaxContainer = document.createElement("div");
    timeMaxContainer.className = "lg:w-1/7 mb-2 lg:mb-0";
    filterForm.appendChild(timeMaxContainer);

    const labelTimeMax = document.createElement("label");
    labelTimeMax.htmlFor = "timePrice";
    labelTimeMax.textContent = "Durée maximale du trajet";
    timeMaxContainer.appendChild(labelTimeMax);

    const timeInputContainer = document.createElement("div");
    timeInputContainer.className = "relative flex items-center mt-2";
    timeMaxContainer.appendChild(timeInputContainer);

    const imputTimeMax = document.createElement("input");
    imputTimeMax.type = "text";
    imputTimeMax.id = "timeMax";
    imputTimeMax.placeholder = "01:00";
    imputTimeMax.className =
        "block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring";
    timeInputContainer.appendChild(imputTimeMax);

    const resetContainer = document.createElement("div");
    resetContainer.className = "lg:w-1/7 mb-2";
    filterForm.appendChild(resetContainer);

    const resetBtn = document.createElement("button");
    resetBtn.className =
        "btnSearch py-3 px-4 w-9/10 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white";
    resetBtn.textContent = "Réinitialiser";
    resetBtn.setAttribute("type", "reset");
    resetContainer.appendChild(resetBtn);

    const submitContainer = document.createElement("div");
    submitContainer.className = "lg:w-1/7";
    filterForm.appendChild(submitContainer);

    const submitBtn = document.createElement("button");
    submitBtn.className =
        "btnSearch py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white";
    submitBtn.textContent = "Appliquer les filtres";
    submitBtn.setAttribute("type", "submit");
    submitContainer.appendChild(submitBtn);

    if (!trips || trips.length === 0) {
        const errorsContainer = document.createElement("div");
        errorsContainer.className = "flex justify-center w-full";
        tripResults.appendChild(errorsContainer);

        const errorTriptext = document.createElement("p");
        errorTriptext.className = "text-xl text-red-600 mt-2";
        errorTriptext.textContent = "Aucun trajet trouvé avec ces critères";
        errorsContainer.appendChild(errorTriptext);

        resetBtn.addEventListener("click", async () => {
            btnEco = null;
            starsNumber = null;
            priceMaxValue = null;
            timeMaxValue = null;
            errorTriptext.textContent = "";

            show(originalTrip, seats);
        });
    } else {
        // TRIPS
        // Date trip
        const containerDate = document.createElement("div");
        containerDate.className = "p-4 md:p-5";
        tripResults.appendChild(containerDate);

        const textDate = document.createElement("p");
        textDate.className = "text-xl font-semibold";
        textDate.textContent = trips[0].date;
        containerDate.appendChild(textDate);

        // trip container
        trips.forEach((trip) => {
            const card = document.createElement("div");
            card.className =
                "pt-2 border border-gray-200 w-8/10 xl:w-1/2 rounded-xl";

            const container = document.createElement("div");
            container.className = "p-4 md:p-5";
            card.appendChild(container);

            // price and places
            const containerPrice = document.createElement("div");
            containerPrice.className =
                "flex justify-between gap-x-2 px-5 pb-3 gap-x-2 pb-2";

            const textPlaces = document.createElement("p");
            textPlaces.className = "text-base md:text-xl font-semibold";
            textPlaces.textContent = `${trip.places} place disponible`;
            containerPrice.appendChild(textPlaces);

            const textPrice = document.createElement("p");
            textPrice.className = "text-lg md:text-2xl font-semibold";
            textPrice.textContent = `${trip.price} Crédits`;
            containerPrice.appendChild(textPrice);

            container.appendChild(containerPrice);

            // times
            const containerTimes = document.createElement("div");
            containerTimes.className = "flex justify-end gap-x-2 pb-2";

            const textdeparture = document.createElement("p");
            textdeparture.className = "text-xs md:text-base font-semibold";
            textdeparture.textContent = trip.hour;

            const lineLeft = document.createElement("div");
            lineLeft.className = "lineLeft my-2 ml-3";

            const textTimeTrip = document.createElement("p");
            textTimeTrip.className = "text-sm md:text-lg font-semibold";
            textTimeTrip.textContent = trip.travelTime;

            const lineRight = document.createElement("div");
            lineRight.className = "lineRight my-2 mr-3";

            const textArrival = document.createElement("p");
            textArrival.className = "text-xs md:text-base font-semibold";
            textArrival.textContent = trip.time;

            containerTimes.appendChild(textdeparture);
            containerTimes.appendChild(lineLeft);
            containerTimes.appendChild(textTimeTrip);
            containerTimes.appendChild(lineRight);
            containerTimes.appendChild(textArrival);
            container.appendChild(containerTimes);

            // city
            const containerCity = document.createElement("div");
            containerCity.className = "flex justify-between gap-x-2 px-5 pb-3";

            const containerLeft = document.createElement("div");
            containerLeft.className = "flex items-center gap-x-2";
            const textcitydeparture = document.createElement("p");
            textcitydeparture.className = "text-sm md:text-base font-semibold";
            textcitydeparture.textContent = trip.departure;
            containerLeft.appendChild(textcitydeparture);

            const containerMiddel = document.createElement("div");
            containerMiddel.className = "flex items-center gap-x-2";
            const textKilometers = document.createElement("p");
            textKilometers.className = "text-sm md:text-base font-semibold";
            textKilometers.textContent = `${trip.kilometers} km`;
            containerMiddel.appendChild(textKilometers);

            const containerRigth = document.createElement("div");
            containerRigth.className = "flex items-center gap-x-2";
            const textCityArrival = document.createElement("p");
            textCityArrival.className = "text-sm md:text-base font-semibold";
            textCityArrival.textContent = trip.arrival;
            containerRigth.appendChild(textCityArrival);

            containerCity.appendChild(containerLeft);
            containerCity.appendChild(containerMiddel);
            containerCity.appendChild(containerRigth);
            container.appendChild(containerCity);

            // user
            const containerUserInfo = document.createElement("div");
            containerUserInfo.className = "flex justify-between gap-x-2";

            // username and photo
            const containerUsername = document.createElement("div");
            containerUsername.className = "flex items-center gap-x-2";

            const img = document.createElement("img");
            img.className =
                "object-cover w-10 h-10 md:w-12 md:h-12 rounded-full";
            img.src = trip.photo;
            img.alt = "photo profil";
            containerUsername.appendChild(img);

            const textUsername = document.createElement("p");
            textUsername.className = "text-sm md:text-base font-semibold";
            textUsername.textContent = trip.username;
            containerUsername.appendChild(textUsername);

            const containernotes = document.createElement("div");
            containernotes.className = "flex items-center gap-x-2";
            const textNotes = document.createElement("p");
            textNotes.className = "text-sm md:text-base font-semibold";

            if (trip.notes !== null) {
                textNotes.textContent = `${trip.notes}/5 étoiles`;
            } else {
                textNotes.textContent = ``;
            }
            containernotes.appendChild(textNotes);

            containerUserInfo.appendChild(containerUsername);
            containerUserInfo.appendChild(containernotes);
            container.appendChild(containerUserInfo);

            // info
            const containerDetails = document.createElement("div");
            containerDetails.className = "flex justify-between mt-3 gap-x-2";

            const containerEnergie = document.createElement("div");
            containerEnergie.className = "flex items-center gap-x-2";
            const textEnergie = document.createElement("p");
            textEnergie.className = "text-xs font-semibold";
            if (trip.energy === "Electrique") {
                textEnergie.textContent =
                    "*voyage écologique = voyage en électrique";
                const logo = document.createElement("img");
                logo.className = "w-auto h-7 w-7";
                logo.src = "/assets/img/logo/form.png";
                logo.alt = "logo";
                containerEnergie.appendChild(logo);
            } else {
                textEnergie.textContent = "";
            }
            containerEnergie.appendChild(textEnergie);

            const linkDetail = document.createElement("a");
            linkDetail.href = `/index.php?controller=car-sharing&action=details&id=${trip.id}&seats=${seats}`;

            const btn = document.createElement("button");
            btn.type = "submit";
            btn.name = "idDetail";
            btn.value = "idDetail";
            btn.textContent = "Détails";
            btn.className =
                "btnSearch px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 rounded-lg focus:outline-none focus:ring";
            linkDetail.appendChild(btn);

            containerDetails.appendChild(containerEnergie);
            containerDetails.appendChild(linkDetail);
            container.appendChild(containerDetails);

            // insert all
            tripResults.appendChild(card);
        });
    }

    // event listners
    const formatTime = (time) => {
        const parts = time.split(":");
        if (parts.length === 2) {
            let hour = Number.parseInt(parts[0], 10);
            let minutes = Number.parseInt(parts[1], 10);

            let hourFormated = hour < 10 ? "0" + hour : hour;
            let minutesFormated = minutes < 10 ? "0" + minutes : minutes;

            time = `${hourFormated}:${minutesFormated}:00`;
        }
        return time;
    };

    let btnEco = null;
    let starsNumber = null;
    let priceMaxValue = null;
    let timeMaxValue = null;
    let filterData = {};

    EcoBtn.addEventListener("click", () => {
        EcoBtn.className =
            "py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-800 text-white hover:bg-teal-600 focus:outline-hidden focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none";
        btnEco = "Electrique";
    });

    starsSelect.addEventListener("change", (e) => {
        let starsstring = e.target.value;

        if (starsstring === "") {
            starsNumber = null;
            errortext.textContent = "";
        } else {
            let stars = Number.parseInt(starsstring, 10);
            if (stars < 1 || stars > 5) {
                errortext.textContent =
                    "Les étoiles doivent être comprises entre 1 et 5.";
                starsNumber = null;
            } else {
                starsNumber = stars;
                errortext.textContent = "";
            }
        }
    });

    imputPricesMax.addEventListener("input", (e) => {
        let price = Number.parseFloat(e.target.value);

        if (Number.isNaN(price) || !Number.isInteger(price)) {
            priceMaxValue = null;
            errortext.textContent = "Veuillez entrer un nombre entier valide.";
        } else if (price.length === 0) {
            priceMaxValue = null;
            errortext.textContent = "";
        } else if (price < 0) {
            priceMaxValue = null;
            errortext.textContent = "Le prix doit être supérieur à zéro.";
        } else {
            priceMaxValue = price;
            errortext.textContent = "";
        }
    });

    imputTimeMax.addEventListener("change", (e) => {
        let time = e.target.value;

        if (!time.match(/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/)) {
            timeMaxValue = null;
            errortext.textContent = "Veuillez remplir au format 01:30";
        } else if (time.length === 0) {
            timeMaxValue = null;
            errortext.textContent = "";
        } else {
            let timeformated = formatTime(time);
            timeMaxValue = timeformated;
            errortext.textContent = "";
        }
    });

    resetBtn.addEventListener("click", async () => {
        btnEco = null;
        starsNumber = null;
        priceMaxValue = null;
        timeMaxValue = null;
        errortext.textContent = "";

        show(originalTrip, seats);
    });

    filterForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        if (
            btnEco !== null ||
            starsNumber !== null ||
            priceMaxValue !== null ||
            timeMaxValue !== null
        ) {
            errortext.textContent = "";

            let datestring = trips[0].date;
            const [day, month, year] = datestring.split("/");
            let dateTrip = `${year}-${month}-${day}`;

            filterData = {
                btnEco: btnEco || null,
                starsNumber: starsNumber || null,
                priceMax: priceMaxValue || null,
                timeMax: timeMaxValue || null,
                departure: trips[0].departure,
                arrival: trips[0].arrival,
                date: dateTrip,
                seats: seats,
            };

            try {
                // fetch api entry point
                const resp = await fetch(API_ENDPOINT, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(filterData),
                });

                const responseData = await resp.json();

                if (resp.ok) {
                    let trips = responseData.trips;
                    let seats = filterData.seats;

                    show(trips, seats);
                    errortext.textContent = "";
                } else if (
                    responseData.message ===
                    "Aucun trajet trouvé avec ces paramètres."
                ) {
                    errortext.textContent = responseData.message;
                    filterData = {
                        btnEco: btnEco || null,
                        starsNumber: starsNumber || null,
                        priceMax: priceMaxValue || null,
                        timeMax: timeMaxValue || null,
                        departure: trips[0].departure,
                        arrival: trips[0].arrival,
                        date: dateTrip,
                        seats: seats,
                    };
                } else {
                    errortext.textContent = responseData.message;
                }
            } catch (error) {
                alert(`Connexion échouée : ${error.message}`);
            }
        } else {
            errortext.textContent = "Veuillez remplir au moins un champ.";
        }
    });
}
