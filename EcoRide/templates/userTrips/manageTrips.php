<section id="manageTripPage" class="mt-5">

    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <!-- Card Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Grid -->
        <div class="grid grid-cols-1 gap-4 sm:gap-6">
            <h3>Conducteur :</h3>
            <?php foreach ($trips as $trip) {?>

                <!-- Card -->
                <div class="flex flex-col border border-gray-200 rounded-xl">
                    <div class="p-4 md:p-5">
                        <div class="flex items-center gap-x-2">
                            <p class="text-sm font-semibold text-gray-500">
                                Départ :                                                                                                                            <?php echo $trip->getDepartureCity(); ?>
                            </p>
                            <div class="hs-tooltip">
                                <div class="hs-tooltip-toggle">

                                    <p class="text-sm font-semibold text-gray-500">
                                        Arrivé:                                                                                                                                                 <?php echo $trip->getArrivalCity(); ?>
                                    </p>
                                </div>
                            </div>
                            <p class="text-sm font-semibold text-gray-500">
                                Statut :                                                                                                                         <?php echo $trip->getStatus(); ?>
                            </p>
                        </div>

                        <div class="mt-2 text-gray-800">
                            <p class="font-semibold"> Date depart:                                                                                                                                                                                                       <?php echo $trip->getDepartureDate(); ?></p> <span class="text-gray-500"><?php echo $trip->getDepartureHour(); ?></span>
                        </div>
                        <div class="mt-2 text-gray-800">
                            <p class="font-semibold"> Heure arrivé:                                                                                                                                                                                                             <?php echo $trip->getArrivalTime(); ?></p> <span class="text-gray-500"><?php echo $trip->getNumSeats(); ?></span>
                        </div>
                        <div>
                            <?php $satus = $trip->getStatus();
                                if ($satus === "Programmé") {?>
                                <form method="post">
                                    <input type="hidden" name="tokenDelete" value="<?php echo htmlspecialchars($token); ?>">
                                    <input type="hidden" name="idTrip" value="<?php echo $trip->getId(); ?>">
                                    <button type="submit" name="idDelete" value="idDelete" class="px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none">
                                        Annuler
                                    </button>
                                </form>

                                <form method="post">
                                    <input type="hidden" name="tokenStart" value="<?php echo htmlspecialchars($token); ?>">
                                    <input type="hidden" name="idTripStart" value="<?php echo $trip->getId(); ?>">
                                    <button type="submit" name="idStart" value="idStart" class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                        Démarré
                                    </button>
                                </form>
                            <?php } elseif ($satus === "Démarrer") {?>
                                <form method="post">
                                    <input type="hidden" name="tokenEnd" value="<?php echo htmlspecialchars($token); ?>">
                                    <input type="hidden" name="idTripEnd" value="<?php echo $trip->getId(); ?>">
                                    <button type="submit" name="endSubmit" value="endSubmit" class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                        Arrivé à destination
                                    </button>
                                </form>
                            <?php } else {
                                }?>
                        </div>

                    </div>
                </div>
            <?php }?>
        </div>
        <p>Passager:</p>
    </div>

</section>