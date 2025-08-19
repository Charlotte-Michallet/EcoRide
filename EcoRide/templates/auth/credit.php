<section id="credit" class="mt-5">

    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <div class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-8 mx-auto">
            <h2 class="text-3xl font-semibold text-center capitalize">Crédit</h2>

            <p class="max-w-2xl mx-auto mt-4 text-center xl:mt-6">
                Vous pous remettre du credis
            </p>

            <div class="grid grid-cols-1 gap-8 mt-6 xl:mt-12 xl:gap-12 md:grid-cols-2 lg:grid-cols-3">
                <div class="w-full p-8 space-y-8 text-center border border-gray-200 rounded-lg">
                    <p class="font-medium text-gray-500 uppercase ">Votre crédits</p>

                    <p class="text-4xl font-semibold text-gray-800">
                        votre credits
                    </p>
                </div>

                <div class="w-full p-8 space-y-8 text-center border border-gray-200 rounded-lg ">
                    <p class="font-medium text-gray-500 uppercase">Recharger</p>
                    <form method="post">
                        <input type="hidden" name="tokenCsrf" id="tokenCsrf"
                            value="<?php echo htmlspecialchars($token) ?>">
                        <input type="number" id="credits" class="text-4xl font-semibold text-gray-800 uppercase " placeholder="50" min="1">

                         <p class="font-medium text-gray-500 uppercase">1€ = 1 Crédit</p>
                         <p class="hidden text-xs text-red-600 mt-2" id="formError"></p>
                         <p class="hidden text-green-600 mt-2" id="succes"></p>
                        <button type="submit" id="creditsAdd" class="w-full px-4 py-2 mt-10 tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                            Recharger
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>