<!-- form -->
<section id="itineraryPage">
    <form action="post" id="formItineray" class="form w-3/4 mx-auto p-5 mt-15 rounded-md shadow-md">
        <div class="flex flex-col">

            <div class="w-full flex items-center gap-6 justify-around">
                <div>
                    <label for="departureItineray">Ville de départ</label>
                    <input type="text" id="departureItineray" class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring" name="departureItineray" placeholder="Ex: Paris">
                    <p class="hidden text-xs text-green-600 mt-2" id="cityDepFound"></p>
                    <p class="hidden text-xs text-red-600 mt-2" id="depatureCityError"></p>
                </div>

                <div>
                    <label for="arrivalItineray">Ville d'arriver</label>
                    <input type="text" id="arrivalItineray" class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring" name="arrivalItineray" placeholder="Ex: Lille">
                    <p class="hidden text-xs text-green-600 mt-2" id="cityArrFound"></p>
                    <p class="hidden text-xs text-red-600 mt-2" id="arrivalCityError"></p>
                </div>

                <div>
                    <label for="departureDateItineray">Date de départ</label>
                    <input type="date" id="departureDateItineray" class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring" name="departureDateItineray">
                    <p class="hidden text-xs text-red-600 mt-2" id="dateError"></p>
                </div>

                <div>
                    <label for="numPassengers">Nombre de passagers</label>
                    <input type="number" id="numPassengersItineray" class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring" name="numPassengersItineray" placeholder="3" min="1">
                    <p class="hidden text-xs text-red-600 mt-2" id="numPlacesError"></p>

                </div>

                <input type="hidden" name="tokenItineray" id="tokenItineray" value="<?php echo htmlspecialchars($token) ?>">


                <div>
                    <button type="submit" id="submitItinery" class="btnSearch item-center px-5 py-2 leading-5 text-white transition-colors duration-300 transform rounded-md focus:outline-none">Rechercher</button>
                </div>
            </div>
            <div class="flex justify-end">
                <p class="hidden text-red-600 mt-2" id="formError"></p>
            </div>

        </div>
    </form>

    <!-- Card -->
    <div id="tripResults" class="flex flex-col items-center gap-6 my-4" >

    </div>


    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 p-5 sm:px-6 lg:px-8 mx-auto">

        <!-- Title -->
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
            <h1 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Soyez ecologique, Econimisez, Partagez, Voyagez</h1>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">Drive Green Together</p>
        </div>

        <!-- Grid -->
        <div class="grid sm:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Card -->
            <div class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-hidden focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-5">
                <div class="aspect-w-16 aspect-h-11">
                    <img class="w-full object-cover rounded-xl" src="https://images.unsplash.com/photo-1666303349369-ad8d7e52add0?q=80&w=1375&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="route dans foret">
                </div>
                <div class="my-6">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Ecologique
                    </h3>
                    <p class="mt-5 text-gray-600">
                        Opteter pour un covoiturage tres ecologique
                    </p>
                </div>

            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-hidden focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-5">
                <div class="aspect-w-16 aspect-h-11">
                    <img class="w-full object-cover rounded-xl" src="/assets/img/aeconomie.jpg" alt="Blog Image">
                </div>
                <div class="my-6">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Economique
                    </h3>
                    <p class="mt-5 text-gray-600">
                        avec le covoiturage economiser
                    </p>
                </div>

            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-hidden focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-5">
                <div class="aspect-w-16 aspect-h-11">
                    <img class="w-full object-cover rounded-xl" src="https://images.unsplash.com/photo-1537646158567-4776a3278452?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="partager un voyage">
                </div>
                <div class="my-6">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Partagez
                    </h3>
                    <p class="mt-5 text-gray-600">
                        partager cette experience avec la communauté
                    </p>
                </div>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-hidden focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-5" href="#">
                <div class="aspect-w-16 aspect-h-11">
                    <img class="w-full object-cover rounded-xl" src="/assets/img/car-map.jpg" alt="Blog Image">
                </div>
                <div class="my-6">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Voyager
                    </h3>
                    <p class="mt-5 text-gray-600">
                        securiter
                    </p>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Grid -->

    </div>
    <!-- End Card Blog -->
<p class="text-xs text-gray-500">* Voyage écologique = voyage en éléctrique </p>
</section>