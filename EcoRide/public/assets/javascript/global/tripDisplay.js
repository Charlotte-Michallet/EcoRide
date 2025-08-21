export function show(trips, seats) {
    tripResults.textContent = "";

    const containerDate = document.createElement("div");
    containerDate.className = "p-4 md:p-5";
    tripResults.appendChild(containerDate);

    const textDate = document.createElement("p");
    textDate.className = "text-xl font-semibold";
    textDate.textContent = trips[0].date;
    containerDate.appendChild(textDate);

    trips.forEach((trip) => {
        const card = document.createElement("div");
        card.className = "pt-2 border border-gray-200 w-1/2 rounded-xl";

        const container = document.createElement("div");
        container.className = "p-4 md:p-5";
        card.appendChild(container);

        // price and places
        const containerPrice = document.createElement("div");
        containerPrice.className =
            "flex justify-between gap-x-2 px-5 pb-3 gap-x-2 pb-2";

        const textPlaces = document.createElement("p");
        textPlaces.className = "text-xl font-semibold";
        textPlaces.textContent = `${trip.places} place disponible`;
        containerPrice.appendChild(textPlaces);

        const textPrice = document.createElement("p");
        textPrice.className = "text-2xl font-semibold";
        textPrice.textContent = `${trip.price} Crédits`;
        containerPrice.appendChild(textPrice);

        container.appendChild(containerPrice);

        // times
        const containerTimes = document.createElement("div");
        containerTimes.className = "flex justify-end gap-x-2 pb-2";

        const textdeparture = document.createElement("p");
        textdeparture.className = "font-semibold";
        textdeparture.textContent = trip.hour;

        const lineLeft = document.createElement("div");
        lineLeft.className = "lineLeft my-2 ml-3";

        const textTimeTrip = document.createElement("p");
        textTimeTrip.className = "text-lg font-semibold";
        textTimeTrip.textContent = trip.travelTime;

        const lineRight = document.createElement("div");
        lineRight.className = "lineRigth my-2 mr-3";

        const textArrival = document.createElement("p");
        textArrival.className = "font-semibold";
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
        textcitydeparture.className = "font-semibold";
        textcitydeparture.textContent = trip.departure;
        containerLeft.appendChild(textcitydeparture);

        const containerMiddel = document.createElement("div");
        containerMiddel.className = "flex items-center gap-x-2";
        const textKilometers = document.createElement("p");
        textKilometers.className = "font-semibold";
        textKilometers.textContent = `${trip.kilometers} km`;
        containerMiddel.appendChild(textKilometers);

        const containerRigth = document.createElement("div");
        containerRigth.className = "flex items-center gap-x-2";
        const textCityArrival = document.createElement("p");
        textCityArrival.className = "font-semibold";
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
        img.className = "object-cover w-12 h-12 rounded-full";
        img.src = trip.photo;
        img.alt = "photo profil";
        containerUsername.appendChild(img);

        const textUsername = document.createElement("p");
        textUsername.className = "font-semibold";
        textUsername.textContent = trip.username;
        containerUsername.appendChild(textUsername);

        const containernotes = document.createElement("div");
        containernotes.className = "flex items-center gap-x-2";
        const textNotes = document.createElement("p");
        textNotes.className = "font-semibold";
        textNotes.textContent = "notes";
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
            textEnergie.textContent = "* Voyage écologique";
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
            "px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80";
        linkDetail.appendChild(btn);

        containerDetails.appendChild(containerEnergie);
        containerDetails.appendChild(linkDetail);
        container.appendChild(containerDetails);

        // insert all
        tripResults.appendChild(card);
    });
}
