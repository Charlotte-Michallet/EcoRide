<!-- form -->
<section id="itineryPage">
    <form action="post" class="form w-3/4 mx-auto p-5 mt-15 rounded-md shadow-md">
        <div class="flex gap-6 justify-around items-center">
            <div>
                <label for="departureHome">Ville de départ</label>
                <input type="text" id="departureHome" class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring" name="departureHome">
            </div>

            <div>
                <label for="arrivalHome">Ville d'arriver</label>
                <input type="text" id="arrivalHome" class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring" name="arrivalHome">
            </div>

            <div>
                <label for="departureDateHome">Date de départ</label>
                <input type="text" id="departureDateHome" class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring" name="departureDateHome">
            </div>

            <div>
                <label for="numPassengers">Nombre de passagers</label>
                <input type="number" id="numPassengers" class="block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring" name="numPassengers">
            </div>

            <input type="hidden" name="token_csrf" value="<?php echo htmlspecialchars($token) ?>">

            <div>
                <button class="btnSearch item-center px-5 py-2 leading-5 text-white transition-colors duration-300 transform rounded-md focus:outline-none">Rechercher</button>
            </div>
        </div>
    </form>

    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 p-5 sm:px-6 lg:px-8 mx-auto">

        <!-- Title -->
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
            <h1 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Ecologique, Econimique, Partagez, sécurité</h1>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">Drive Green Together</p>
        </div>

        <!-- Grid -->
        <div class="grid sm:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Card -->
            <div class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-hidden focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-5">
                <div class="aspect-w-16 aspect-h-11">
                    <img class="w-full object-cover rounded-xl" src="https://images.unsplash.com/photo-1633114128174-2f8aa49759b0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80" alt="Blog Image">
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
                    <img class="w-full object-cover rounded-xl" src="https://images.unsplash.com/photo-1633114128174-2f8aa49759b0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80" alt="Blog Image">
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
                    <img class="w-full object-cover rounded-xl" src="https://images.unsplash.com/photo-1562851529-c370841f6536?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80" alt="Blog Image">
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
            <a class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-hidden focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-5" href="#">
                <div class="aspect-w-16 aspect-h-11">
                    <img class="w-full object-cover rounded-xl" src="https://images.unsplash.com/photo-1521321205814-9d673c65c167?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80" alt="Blog Image">
                </div>
                <div class="my-6">
                    <h3 class="text-xl font-semibold text-gray-800">
                       securiter
                    </h3>
                    <p class="mt-5 text-gray-600">
                        securiter
                    </p>
                </div>
            </a>
            <!-- End Card -->
        </div>
        <!-- End Grid -->

    </div>
    <!-- End Card Blog -->
</section>