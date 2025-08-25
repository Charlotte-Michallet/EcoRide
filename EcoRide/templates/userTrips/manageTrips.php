<section id="manageTripPage" class="mt-5">

    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <!-- Card Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Grid -->
        <?php if ($_SESSION["role"] === 2 || $_SESSION["role"] === 3 || $_SESSION["role"] === 5) {?>
            <div class="grid grid-cols-1 gap-4 sm:gap-6">
                <h3>Conducteur :</h3>
                <!-- Card -->

                <?php foreach ($trips as $trip) {?>

                    <!-- Card -->
                    <div class="pt-2 border border-gray-200 rounded-xl">
                        <div class="p-4 md:p-5">

                            <div class="flex justify-between gap-x-2 pb-2">
                                <div class="flex items-center gap-x-2">
                                    <p class="font-semibold">                                                                                                                                                                                        <?php echo $trip->getDepartureDate(); ?></span></p>
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
                                <div class="lineLeft my-2 ml-2"></div>

                                <div class="flex items-center gap-x-2">
                                    <p class="font-semibold"><?php echo $trip->getKilometers(); ?> km</p>
                                </div>
                                <div class="lineRigth my-2 mr-2"></div>

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
                                    <p class="font-semibold">Places disponible :
                                        <span><?php echo $trip->getNumSeats(); ?></span>
                                    </p>
                                </div>

                                <div class="flex items-center gap-x-2 pb-2">
                                    <div class="flex items-center gap-x-2 ">
                                        <?php $satus = $trip->getStatus();
                                            if ($satus === "Programmé") {?>
                                            <form method="post">
                                                <input type="hidden" name="tokenDelete"
                                                    value="<?php echo htmlspecialchars($token); ?>">
                                                <input type="hidden" name="idTrip" value="<?php echo $trip->getId(); ?>">
                                                <button type="submit" name="idDelete" value="idDelete"
                                                    class="px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none">
                                                    Annuler
                                                </button>
                                            </form>

                                            <form method="post">
                                                <input type="hidden" name="tokenStart"
                                                    value="<?php echo htmlspecialchars($token); ?>">
                                                <input type="hidden" name="idTripStart" value="<?php echo $trip->getId(); ?>">
                                                <button type="submit" name="idStart" value="idStart"
                                                    class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                                    Démarré
                                                </button>
                                            </form>
                                        <?php } elseif ($satus === "Démarrer") {?>
                                            <form method="post">
                                                <input type="hidden" name="tokenEnd"
                                                    value="<?php echo htmlspecialchars($token); ?>">
                                                <input type="hidden" name="idTripEnd" value="<?php echo $trip->getId(); ?>">
                                                <button type="submit" name="endSubmit" value="endSubmit"
                                                    class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
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
        <?php }?>
<?php if ($_SESSION["role"] === 2 || $_SESSION["role"] === 4 || $_SESSION["role"] === 5) {?>
            <div class="grid grid-cols-1 gap-4 sm:gap-6">
                <h3 class="pt-3">Passager:</h3>

                <?php
                foreach ($reservations as $reservation) {?>

                    <!-- Card -->
                    <div class="pt-2 border border-gray-200 rounded-xl">
                        <div class="p-4 md:p-5">

                            <div class="flex justify-between gap-x-2 pb-2">
                                <div class="flex items-center gap-x-2">
                                    <p class="font-semibold">                                                                                                                                                                                        <?php echo $reservation->getDepartureDate(); ?></span></p>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <p class="font-semibold">
                                        <span><?php echo $reservation->getNumSeatsBookes(); ?></span> place reservé
                                    </p>
                                    <p class="font-semibold"><?php echo $reservation->getPrices(); ?> credit</p>
                                </div>
                            </div>

                            <div class="flex justify-between gap-x-2 pb-2">
                                <div class="flex items-center gap-x-2">
                                    <p class="font-semibold"><?php echo $reservation->getDepartCity(); ?></p>
                                </div>
                                <div class="lineLeft my-2 ml-2"></div>

                                <div class="flex items-center gap-x-2">
                                    <p class="font-semibold"><?php echo $reservation->getKilometer(); ?> km</p>
                                </div>
                                <div class="lineRigth my-2 mr-2"></div>

                                <div class="flex items-center gap-x-2">
                                    <p class="font-semibold"><?php echo $reservation->getArriCity(); ?></p>
                                </div>
                            </div>


                            <div class="flex justify-between gap-x-2 px-5 pb-3">
                                <div class="flex items-center gap-x-2 ">
                                    <p class="font-semibold"><?php echo $reservation->getDepartHour(); ?></p>
                                </div>

                                <div class="flex items-center gap-x-2 ">
                                    <p class="font-semibold"><?php echo $reservation->getTravelTime(); ?></p>
                                </div>

                                <div class="flex items-center gap-x-2 ">
                                    <p class="font-semibold"><?php echo $reservation->getArrTime(); ?></p>
                                </div>
                            </div>

                            <div class="flex justify-between gap-x-2 bg-gray-200">
                                <div class="flex items-center gap-x-2 ">
                                    <p class="font-semibold">numero de reservation
                                        <span><?php echo $reservation->getNumReser(); ?></span>
                                    </p>
                                </div>

                                <div class="flex items-center gap-x-2 ">
                                    <p class="font-semibold"><?php echo $reservation->getPaymentStatus(); ?>
                                    </p>
                                    <p class="font-semibold"><?php echo $reservation->getStatus(); ?>
                                    </p>

                                </div>
                            </div>

                            <div class="flex justify-between gap-x-2">
                                <div class="flex items-center gap-x-2 ">
                                    <p class="font-semibold">Conducteur :
                                        <span><?php echo $reservation->getUsername(); ?></span>
                                    </p>

                                    <div class="flex items-center gap-x-2 ">
                                        <p class="font-semibold"> Voiture :</p>
                                        <p class="font-semibold"><?php echo $reservation->getBrand(); ?></p>
                                        <p class="font-semibold"><?php echo $reservation->getModel(); ?></p>
                                        <p class="font-semibold"><?php echo $reservation->getColor(); ?></p>
                                    </div>

                                    <div class="flex items-center gap-x-2 ">
                                        <p class="font-semibold"> covoiturage status :</p>
                                        <p class="font-semibold"><?php echo $reservation->getStatusCarSharing(); ?></p>
                                    </div>
                                </div>

                            </div>

                            <div class="flex justify-end mr-3">


                                <?php $status = $reservation->getStatusCarSharing();
                                        $reservStatus                                 = $reservation->getStatus();
                                    if ($reservStatus === "Avis en attente de validation") {} elseif ($status === "Programmé") {?>
                                    <form method="post">
                                        <input type="hidden" name="tokenDeleteReserva"
                                            value="<?php echo htmlspecialchars($token); ?>">
                                        <input type="hidden" name="idReservation" value="<?php echo $reservation->getId(); ?>">
                                        <input type="hidden" name="seatsReserved"
                                            value="<?php echo $reservation->getNumSeatsBookes(); ?>">
                                        <input type="hidden" name="idCarSharing"
                                            value="<?php echo $reservation->getCarSharingId(); ?>">

                                        <input type="hidden" name="credits" value="<?php echo $reservation->getPrices(); ?>">
                                        <input type="hidden" name="carSharingStatus"
                                            value="<?php echo $reservation->getCarSharingId(); ?>">

                                        <button type="submit" name="deleteReservation" value="deleteReservation"
                                            class="px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none">Annuler</button>
                                    </form>

                                <?php } elseif ($status === "Arrivée à destination") {
                                        $id = $reservation->getId(); ?>
                                    <a href="/index.php?controller=car-sharing&action=feedbacks&reservation=<?php echo $id ?>"
                                        class="px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none">Donnez
                                        votre avis</a>
                                <?php }?>
                            </div>
                        <?php }?>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</section>