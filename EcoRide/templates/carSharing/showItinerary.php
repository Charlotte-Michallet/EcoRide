<h1>show</h1>

<!-- form -->
<section class="form w-3/4 mx-auto p-5 bg-white rounded-md shadow-md">
    <form action="post">
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

            <input type="hidden" name="token_csrf" value="<?= htmlspecialchars($token) ?>">

            <div>
                <button class="btnSearch item-center px-5 py-2 leading-5 text-white transition-colors duration-300 transform rounded-md focus:outline-none">Rechercher</button>
            </div>

        </div>
    </form>
</section>