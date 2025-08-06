<section id="createTripePage" class="mt-5">
    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <div class="flex justify-center">

        <div class="flex w-full py-4 px-10 mx-auto w-1/9">
            <div class="w-full">
                <h1 class="text-2xl font-semibold tracking-wider capitalize">
                    Créer votre trajet
                </h1>

                <p class="mt-2 text-sm text-gray-500">Aider la planet a etre plus verte</p>

                <form class="grid grid-cols-1 mt-3 gap-6 md:grid-cols-2" method="post">

                    <div>
                        <label for="departureCity" class="block mb-2 text-sm">Point de départ</label>
                        <div class="relative">
                            <input type="text" id="departureCity" name="departureCity" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" placeholder="Ex: Lyon">
                        </div>

                        <p class="hidden text-xs text-green-600 mt-2" id="cityFound"></p>
                        <p class="hidden text-xs text-red-600 mt-2" id="depatureCityError"></p>
                    </div>

                    <div>
                        <label for="arrivalCity" class="block mb-2 text-sm">Point d'arrivée</label>
                        <div class="relative">
                            <input type="text" id="arrivalCity" name="arrivalCity" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" placeholder="Ex: Lyon">
                        </div>

                        <p class="hidden text-xs text-green-600 mt-2" id="CitFound"></p>
                        <p class="hidden text-xs text-red-600 mt-2" id="arrivalCityError"></p>
                    </div>

                    <div>
                        <label for="numPlaces" class="block mb-2 text-sm">Nombre de passager</label>
                        <div>
                            <input type="number" id="numPlaces" name="numPlaces" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" min="1" max="9" aria-describedby="numspaceerror" placeholder="4">
                        </div>

                        <p class="hidden text-xs text-red-600 mt-2" id="numPlacesError"></p>
                    </div>

                    <div>
                        <label for="dateDeparture" class="block mb-2 text-sm">Date de départ</label>
                        <div class="relative">
                            <input type="date" id="dateDeparture" name="dateDeparture" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" placeholder="Basic time picker">
                        </div>

                        <p class="hidden text-xs text-red-600 mt-2" id="dateError"></p>
                    </div>

                    <div>
                        <!-- hours -->
                        <label for="hourDeparture" class="block mb-2 text-sm">Heure du départ</label>
                        <div class="relative">
                            <input type="time" id="hourDeparture" name="hourDeparture" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none">

                            <p class="hidden text-xs text-red-600 mt-2" id="hourDepartureError"></p>
                        </div>
                    </div>

                    <div>
                        <label for="priceTrip" class="block mb-2 text-sm">Fixez votre prix par place</label>
                        <div class="relative">
                            <input type="number" id="priceTrip" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" name="priceTrip" min="2" placeholder="4 Crédit"/>
                            <p class="text-sm mt-2" id="calcperson"> ~0,10 Crédits / km</p>
                            <p class="text-sm mt-2" id="CitFound">* Frais de services 2 Crédits / 1Crédits = 1€</p>

                            <p class="hidden text-xs text-red-600 mt-2" id="pricesError"></p>

                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="inline-flex gap-x-2 text-sm">
                            <img class="w-auto h-7 w-7" src="<?php ROOT_PATH?> /assets/img/logo/form.png" alt="logo EcoRide">
                            <p>* Voyage écologique = voyage en éléctrique</p>
                        </div>
                    </div>

                    <div>
                        <label for="chooseCar" class="block text-sm mb-2">Choisissez votre voiture</label>
                        <select name="chooseCar" id="chooseCar">
                            <option value="choose"> --- Choisissez une Voiture --- </option>
                            <?php foreach ($cars as $car) {?>
                                <option value="<?php echo $car->getId() ?>"><?php echo $car->getBrand() ?> /<?php echo $car->getModel() ?> /<?php echo $car->getNumplate() ?> /<?php echo $car->getEnergyType() ?></option>
                            <?php }?>
                        </select>

                        <a href="http://localhost:8080/index.php?controller=auth&action=cars">
                            <p class="text-xs mt-3" id="newCar">Vous voulez ajoutez une nouvelle voiture</p>
                        </a>
                        <p class="hidden text-xs text-red-600 mt-2" id="TripFormError"></p>
                    </div>

                    <input type="hidden" name="token_csrf" id="tokenTrip" value="<?php echo htmlspecialchars($token) ?>">

                    <button type="submit"
                                class="btn flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-300 transform rounded-lg md:col-start-1">
                                <span>Créer le trajet</span>

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                </form>
            </div>
        </div>

        <div class="hidden lg:block p-8 mx-auto w-8/9">
            <div id="mapid"></div>
            <p class="bg-gray-100 py-2 px-5 mb-5" id="travelInfo">Distance : --km - Durée : --h --min</span></p>
        </div>
    </div>
</section>