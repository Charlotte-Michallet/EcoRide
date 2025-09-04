<section id="itineraryPage">
    <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === 3) {?>

        <div class="max-w-3xl flex flex-col mx-auto size-full">

            <div class="text-center py-10 px-4 sm:px-6 lg:px-8">
                <h1 class="block text-3xl font-bold text-gray-800 ">Veuillez changer de rôle pour accéder aux fonctionnalités.
                </h1>

                <div class="mt-5 flex flex-col justify-center items-center gap-2 sm:flex-row sm:gap-3">
                    <a class="btn w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border text-white"
                        href="/index.php?controller=auth&action=profilModify">
                        Changer de rôle
                    </a>
                </div>
            </div>
        </div>

    <?php } else {?>
        <form action="post" id="formItinerary" class="form w-3/4 mx-auto p-5 mt-15 rounded-md shadow-md border border-gray-200">
            <div class="flex flex-col">
                <div class="w-full flex items-center gap-6 justify-around">
                    <div>
                        <label for="departureItinerary">Ville de départ</label>
                        <input type="text" id="departureItinerary"
                            class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring"
                            name="departureItinerary" placeholder="Ex: Paris">
                        <p class="hidden text-xs text-green-600 mt-2" id="cityDepFound"></p>
                        <p class="hidden text-xs text-red-600 mt-2" id="depatureCityError"></p>
                    </div>

                    <div>
                        <label for="arrivalItinerary">Ville d'arrivée</label>
                        <input type="text" id="arrivalItinerary"
                            class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring"
                            name="arrivalItinerary" placeholder="Ex: Lille">
                        <p class="hidden text-xs text-green-600 mt-2" id="cityArrFound"></p>
                        <p class="hidden text-xs text-red-600 mt-2" id="arrivalCityError"></p>
                    </div>

                    <div>
                        <label for="departureDateItinerary">Date de départ</label>
                        <input type="date" id="departureDateItinerary"
                            class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring"
                            name="departureDateItinerary">
                        <p class="hidden text-xs text-red-600 mt-2" id="dateError"></p>
                    </div>

                    <div>
                        <label for="numPassengers">Nombre de passagers</label>
                        <input type="number" id="numPassengersItinerary"
                            class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring"
                            name="numPassengersItinerary" placeholder="3" min="1" max="8">
                        <p class="hidden text-xs text-red-600 mt-2" id="numPlacesError"></p>
                    </div>

                    <input type="hidden" name="tokenItinerary" id="tokenItinerary"
                        value="<?php echo htmlspecialchars($token) ?>">
                    <div>
                        <button type="submit" id="submitItinerary"
                            class="btnSearch item-center px-5 py-2 leading-5 text-white transition-colors duration-300 transform rounded-md focus:outline-none">Rechercher</button>
                    </div>
                </div>
                <div class="flex justify-end">
                    <p class="hidden text-red-600 mt-2" id="formError"></p>
                </div>
            </div>
        </form>

        <!-- Card trip-->
        <div id="tripResults" class="flex flex-col items-center gap-6 my-4"></div>

        <!-- Card info -->
        <div class="max-w-[85rem] px-4 p-5 sm:px-6 lg:px-8 mx-auto">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h1 class="text-2xl font-bold md:text-4xl md:leading-tight">Partagez, Économisez, Respirez, Voyagez!</h1>
                <p class="mt-1 text-gray-600 mt-3">Drive Green Together</p>
            </div>

            <div class="grid sm:grid-cols-3 lg:grid-cols-4 gap-6">
                <div
                    class="group flex flex-col h-full border border-gray-200 hover:border-gray-300 hover:shadow-lg transition duration-300 rounded-xl p-5">
                    <div class="aspect-w-16 aspect-h-11">
                        <img class="w-full object-cover rounded-xl"
                            src="https://images.unsplash.com/photo-1537646158567-4776a3278452?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Personnes partagent un voyage">
                    </div>
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Partagez
                        </h3>
                        <p class="mt-5 text-gray-600">
                           Vivez l’expérience du covoiturage en partageant vos trajets avec une communauté solidaire. Rencontrez des conducteurs et passagers qui veulent voyager de manière responsable tout en tissant des liens.
                        </p>
                    </div>
                </div>

                <div
                    class="group flex flex-col h-full border border-gray-200 hover:border-gray-300 hover:shadow-lg transition duration-300 rounded-xl p-5">
                    <div class="aspect-w-16 aspect-h-11">
                        <img class="w-full object-cover rounded-xl" src="/assets/img/economy.jpg" alt="Pièces dans vide-poche de voiture">
                    </div>
                    <div class="my-6">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Économisez
                        </h3>
                        <p class="mt-5 text-gray-600">
                           Économisez sur chaque trajet et contribuez à un mode de transport plus durable pour aujourd’hui et demain.
                        </p>
                    </div>
                </div>

                <div
                    class="group flex flex-col h-full border border-gray-200 hover:border-gray-300 hover:shadow-lg transition duration-300 rounded-xl p-5">
                    <div class="aspect-w-16 aspect-h-11">
                        <img class="w-full object-cover rounded-xl"
                            src="https://images.unsplash.com/photo-1666303349369-ad8d7e52add0?q=80&w=1375&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Route dans foret">
                    </div>
                    <div class="my-6">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Respirez
                        </h3>
                        <p class="mt-5 text-gray-600">
                            Voyagez responsablement, respirez la nature et agissez pour la planète grâce à un covoiturage écologique et convivial.
                        </p>
                    </div>
                </div>

                <div class="group flex flex-col h-full border border-gray-200 hover:border-gray-300 hover:shadow-lg transition duration-300 rounded-xl p-5">
                    <div class="aspect-w-16 aspect-h-11">
                        <img class="w-full object-cover rounded-xl" src="/assets/img/car-map.jpg" alt="Voiture sur une carte">
                    </div>
                    <div class="my-6">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Voyagez
                        </h3>
                        <p class="mt-5 text-gray-600">
                          Découvrez la France autrement et facilitez vos déplacements, qu’ils soient quotidiens ou longue distance, grâce au covoiturage.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end mx-5 mb-10">
            <p class="text-xs text-gray-500">* Voyage écologique = voyage en électrique </p>
        </div>

    <?php }?>
</section>