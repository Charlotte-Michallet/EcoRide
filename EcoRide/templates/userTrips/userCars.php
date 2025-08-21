<section id="useCarsPage" class="mt-5">
<!-- car -->
    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <!-- Table Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-xl shadow-2xs overflow-hidden">

                        <!-- Header -->
                        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                            <div>
                                <h2 class="text-xl font-semibold">
                                    Mes voitures
                                </h2>
                            </div>

                            <div>
                                <div class="inline-flex gap-x-2">

                                    <button type="button" id="btnOpenModal" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-modal-signup" data-hs-overlay="#hs-modal-signup">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14" />
                                            <path d="M12 5v14" />
                                        </svg>
                                        Ajouter une voiture
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase">Marque</span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase">Modele</span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase">Type d'energie utiliser</span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase">Nombre de place maximum</span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase">Immatriculation</span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase">Date première immatriculation</span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase ">Couleur</span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase ">Supprimer</span>
                                        </div>
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-300 ">

                                <?php foreach ($cars as $car) {?>

                                    <!-- Row -->
                                    <tr>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="ps-6 py-3">
                                            <p><?php echo $car->getBrand(); ?></p>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <p><?php echo $car->getModel(); ?></p>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <p><?php echo $car->getEnergyType(); ?></p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <p><?php echo $car->getNumSeats(); ?></p>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <p><?php echo $car->getNumplate(); ?></p>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                            <p><?php echo $car->getFirstRegisterDate(); ?></p>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                            <p><?php echo $car->getColor(); ?></p>
                                            </div>
                                        </td>


                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                           <form method="post">
                                                <input type="hidden" name="idCarDelete" value="<?php echo $car->getId(); ?>">
                                                <input type="hidden" name="token_csrf" value="<?php echo htmlspecialchars($token); ?>">
                                                <button class="text-sm" name="submitDeleteCar" value="submitDeleteCar" type="submit">Supprimer</button>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }?>

                            </tbody>
                        </table>

                        <!-- Footer -->
                        <div class="bg-gray-50/60 px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-300">
                            <div>
                                <p class="text-sm text-gray-600">
                                   Drive Green Together
                                </p>
                            </div>

                            <div class="flex items-center">
                                <div class="text-xs inline-flex gap-x-2">
                                    <img class="w-auto h-7 w-7" src="<?php ROOT_PATH?> /assets/img/logo/form.png" alt="logo EcoRide">
                                    <p>*Voyage écologique = voyage en éléctrique</p>
                                </div>
                            </div>
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="addCarModal" class="hidden bg-gray-500/50 size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1" aria-labelledby="hs-modal-signup-label">
        <div id="addCaroverlay" class="hidden hs-overlay-open:mt-7  hs-overlay-open:duration-500 mt-5 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="bg-white border border-gray-200 rounded-xl shadow-2xs">
                <div class="p-4 sm:p-7">
                    <div class="text-center">
                        <h3 id="hs-modal-signup-label" class="block text-2xl font-bold ">Ajouter une voiture</h3>
                        <button id="closeModal" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">X</button>
                    </div>

                    <!-- Form -->
                    <form id="addCarForm" method="post">
                        <div class="grid gap-y-4">

                            <div>
                                <label for="brandCreate" class="block text-sm mb-2">Marque de la voiture</label>
                                    <input type="text" id="brandCreate" name="brandCreate" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" aria-describedby="brandrror" placeholder="Renault">
                                <p class="hidden text-xs text-red-600 mt-2" id="brandError"></p>
                            </div>

                            <div>
                                <label for="modelCreate" class="block text-sm mb-2">Model de la voiture</label>
                                    <input type="text" id="modelCreate" name="modelCreate" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" aria-describedby="modelerror" placeholder="Zoe">
                                <p class="hidden text-xs text-red-600 mt-2" id="modelError"></p>
                            </div>

                            <div>
                                <label for="energyType" class="block text-sm mb-2">Type d'energie de la voiture</label>
                                <select name="energyType" id="energyType">
                                    <option value="Energy">-- Choisissez un type d'energie --</option>
                                    <option value="Electrique">Electrique</option>
                                    <option value="Hybride">Hybride</option>
                                    <option value="Thermique">Thermique</option>
                                </select>
                            </div>

                            <div>
                                <label for="numSpaces" class="block text-sm mb-2">Nombre de place total de la voiture</label>
                                    <input type="number" id="numSpaces" name="numSpaces" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" min="2" max="9" aria-describedby="numspaceerror" placeholder="5">
                                <p class="hidden text-xs text-red-600 mt-2" id="seatsError"></p>
                            </div>

                             <div>
                                <label for="nbPlate" class="block text-sm mb-2">Numéro d'immatriculation</label>
                                    <input type="text" id="nbPlate" name="nbPlate" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" aria-describedby="numplateerror" placeholder="XX-000-XX">
                                <p class="hidden text-xs text-red-600 mt-2" id="numplateError"></p>
                            </div>

                            <div>
                                <label for="dateNbPlate" class="block text-sm mb-2">Date de la première immatriculation</label>
                                    <input type="date" id="dateNbPlate" name="dateNbPlate" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" aria-describedby="datenumplateerror" >
                                <p class="hidden text-xs text-red-600 mt-2" id="datenumplateError"></p>
                            </div>

                            <div>
                                <label for="colorCreate" class="block text-sm mb-2">Couleur de la voiture</label>
                                    <input type="text" id="colorCreate" name="colorCreate" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" aria-describedby="colorerror" placeholder="Blanc">
                                <p class="hidden text-xs text-red-600 mt-2" id="formError"></p>
                            </div>

                            <input type="hidden" id="tokenCsrf" name="tokenCsrf" value="<?php echo htmlspecialchars($token) ?>">
                            <button id="btnAddCar" type="submit" name="newCar" value="newCar" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50">Ajouter la voiture</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>