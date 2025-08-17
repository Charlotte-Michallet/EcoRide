<section id="manageTripPage" class="mt-5">

    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <!-- Card Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Grid -->
        <div class="grid grid-cols-1 gap-4 sm:gap-6">
            <h3>Conducteur :</h3>
            <!-- Card -->

            <?php foreach ($trips as $trip) {?>

                <!-- Card -->
                <div class="pt-2 border border-gray-200 rounded-xl">
                    <div class="p-4 md:p-5">

                        <div class="flex justify-between gap-x-2 pb-2">
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold">                                                                                                                                                                                                                                                                                                                                                                                                                <?php echo $trip->getDepartureDate(); ?></span></p>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold">
                                    <?php echo $trip->getStatus(); ?></span>
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2 pb-2">
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold"><?php echo $trip->getDepartureCity(); ?></p>
                            </div>
                            <div class="line my-2 mx-6"></div>

                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold"><?php echo $trip->getKilometers(); ?> km</p>
                            </div>
                            <div class="line my-2 mx-6"></div>

                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold"><?php echo $trip->getArrivalCity(); ?></p>
                            </div>
                        </div>


                        <div class="flex justify-between gap-x-2 px-5 pb-3">
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold"><?php echo $trip->getDepartureHour(); ?></p>
                            </div>

                             <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold"><?php echo $trip->getTravel_time(); ?></p>
                            </div>

                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold"><?php echo $trip->getArrivalTime(); ?></p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2">
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold">Places disponible : <span><?php echo $trip->getNumSeats(); ?></span></p>
                            </div>

                            <div class="flex items-center gap-x-2 pb-2">
                                <div class="flex items-center gap-x-2 ">
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
                    </div>
                </div>
            <?php }?>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:gap-6">
            <h3 class="pt-3">Passager:</h3>

            <?php
                foreach ($trips as $trip) {
                ?>

                <!-- Card -->
                <div class="pt-2 border border-gray-200 rounded-xl">
                    <div class="p-4 md:p-5">

                        <div class="flex justify-between gap-x-2 pb-2">
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold"></span></p>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold">
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2 pb-2">
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold">Départ</p>
                            </div>
                            <div class="line my-2 mx-6"></div>

                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold">Arrivé</p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2 px-5 pb-3">
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold">

                                </p>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold"></p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2 px-5 pb-3">
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold"></p>
                            </div>

                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold"></p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2">
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold">Places disponible : <span></span></p>
                            </div>

                            <div class="flex items-center gap-x-2 pb-2">
                                <div class="flex items-center gap-x-2 ">
                                    <form method="post">
                                        <input type="hidden" name="tokenDeletePassenger" value="<?php echo htmlspecialchars($token); ?>">
                                        <input type="hidden" name="idTripPassenger" value="<?php echo $trip->getId(); ?>">
                                        <button type="submit" name="idDeletePassenger" value="idDeletePassenger" class="px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none">
                                            Annuler
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>

    </div>
</section>