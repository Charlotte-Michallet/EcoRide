<section id="credit" class="mt-5">
    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <div class="bg-white">
        <div class="container px-6 py-8 mx-auto">
            <h2 class="text-3xl font-semibold text-center capitalize">Crédit</h2>

            <p class="text-4xl mx-auto mt-4 text-center xl:mt-6">
                Vous pous remettre du credis
            </p>

            <div class="grid grid-cols-1 gap-8 mt-6 xl:mt-12 xl:gap-12 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center justify-center w-full p-8 space-y-8 text-center border border-gray-200 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-700 uppercase ">Votre crédits</p>
                    <p class="text-3xl font-semibold mt-5">
                       <span><?php echo $credits ?> </span> Crédits
                    </p>
                    </div>
                </div>

                <div class="w-full p-8 space-y-8 text-center border border-gray-200 rounded-lg">
                    <p class="font-medium uppercase">Recharger</p>
                    <form method="post">
                        <input type="hidden" name="tokenCsrf" id="tokenCsrf"
                            value="<?php echo htmlspecialchars($token) ?>">
                        <input type="number" id="credits" class="text-4xl font-semibold block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" placeholder="50" min="1">

                         <p class="font-medium text-gray-500 uppercase">1€ = 1 Crédit</p>
                         <p class="hidden text-xs text-red-600 mt-2" id="formError"></p>
                         <p class="hidden text-green-600 mt-2" id="succes"></p>
                        <button type="submit" id="creditsAdd" class="btnSearch w-full px-4 py-2 mt-10 tracking-wide text-white capitalize transition-colors duration-300 transform rounded-md">
                            Recharger
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>