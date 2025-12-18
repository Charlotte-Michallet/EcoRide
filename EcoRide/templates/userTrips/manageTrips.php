<section class="mt-5">
    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="grid grid-cols-1 gap-4 sm:gap-6">
            <h3 class="text-2xl font-semibold">Mes trajets conduits :</h3>
            <?php foreach ($trips as $trip) {?>
                <div class="pt-2 border border-gray-200 rounded-xl">
                    <div class="p-4 md:p-5">
                        <div class="flex justify-between gap-x-2 pb-2">
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold text-sm md:text-xl"><span><?php echo $trip->getDepartureDate(); ?></span></p>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold text-xs md:text-lg">
                                    <span><?php echo $trip->getStatus(); ?></span>
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2 pb-2">
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold text-xs md:text-lg"><span><?php echo $trip->getDepartureCity(); ?></span></p>
                            </div>
                            <div class="lineLeft my-2 ml-2"></div>
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold text-xs md:text-lg"><span><?php echo $trip->getKilometers(); ?></span> km</p>
                            </div>
                            <div class="lineRight my-2 mr-2"></div>
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold text-xs md:text-lg"><span><?php echo $trip->getArrivalCity(); ?></span></p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2 px-5 pb-3">
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold text-xs md:text-lg"><span><?php echo $trip->getDepartureHour(); ?></span></p>
                            </div>
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold text-xs md:text-lg"><span><?php echo $trip->getTravel_time(); ?></span></p>
                            </div>
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold text-xs md:text-lg"><span><?php echo $trip->getArrivalTime(); ?></span></p>
                            </div>
                        </div>

                        <div class="sm:flex justify-between gap-x-2">
                            <div class="flex items-center gap-x-2 mb-3 sm:mb-0">
                                <p class="font-semibold text-xs md:text-lg">Places disponibles :<span><?php echo $trip->getNumSeats(); ?></span>
                                </p>
                            </div>
                            <div class="flex items-center gap-x-2 pb-2">
                                <div class="flex items-center gap-x-2 ">
                                    <?php $status = $trip->getStatus();
                                        if ($status === "Programmé") {?>
                                        <form method="post">
                                            <input type="hidden" name="tokenDelete"
                                                value="<?php echo htmlspecialchars($token); ?>">
                                            <input type="hidden" name="idTrip" value="<?php echo $trip->getId(); ?>">
                                            <input type="hidden" name="dateTrip"
                                                value="<?php echo $trip->getDepartureDate(); ?>">
                                            <input type="hidden" name="departureTrip"
                                                value="<?php echo $trip->getDepartureCity(); ?>">
                                            <input type="hidden" name="arrivalTrip"
                                                value="<?php echo $trip->getArrivalCity(); ?>">
                                            <button type="submit" name="idDelete" value="idDelete"
                                                class="btnCancel px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform rounded-lg">
                                                Annuler
                                            </button>
                                        </form>

                                        <form method="post">
                                            <input type="hidden" name="tokenStart"
                                                value="<?php echo htmlspecialchars($token); ?>">
                                            <input type="hidden" name="idTripStart" value="<?php echo $trip->getId(); ?>">
                                            <button type="submit" name="idStart" value="idStart"
                                                class="btnSearch px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform rounded-lg">
                                                Démarré
                                            </button>
                                        </form>
                                    <?php } elseif ($status === "Démarrer") {?>
                                        <form method="post">
                                            <input type="hidden" name="tokenEnd"
                                                value="<?php echo htmlspecialchars($token); ?>">
                                            <input type="hidden" name="idTripEnd" value="<?php echo $trip->getId(); ?>">
                                            <button type="submit" name="endSubmit" value="endSubmit"
                                                class="btnSearch px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 rounded-lg focus:outline-none focus:ring ">
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
            <h3 class="text-2xl font-semibold pt-3">Mes trajets en passager : </h3>
            <?php foreach ($reservations as $reservation) {?>
                <div class="pt-2 border border-gray-200 rounded-xl">
                    <div class="p-4 md:p-5">
                        <div class="flex justify-between gap-x-2 pb-2">
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold text-sm md:text-xl">
                                    <span><?php echo $reservation->getDepartureDate(); ?></span>
                                </p>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold text-xs md:text-lg">
                                    <span><?php echo $reservation->getNumSeatsBookes(); ?></span> place réservée
                                </p>
                                <p class="font-semibold text-sm md:text-xl"><?php echo $reservation->getPrices(); ?> credit</p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2 pb-2">
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold text-xs md:text-lg"><?php echo $reservation->getDepartCity(); ?></p>
                            </div>
                            <div class="lineLeft my-2 ml-2"></div>
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold text-xs md:text-lg"><?php echo $reservation->getKilometer(); ?> km</p>
                            </div>
                            <div class="lineRight my-2 mr-2"></div>
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold text-xs md:text-lg"><?php echo $reservation->getArriCity(); ?></p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2 px-5 pb-3">
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold text-xs md:text-lg"><?php echo $reservation->getDepartHour(); ?></p>
                            </div>
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold text-xs md:text-lg"><?php echo $reservation->getTravelTime(); ?></p>
                            </div>
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold text-xs md:text-lg"><?php echo $reservation->getArrTime(); ?></p>
                            </div>
                        </div>

                        <div class="md:flex md:justify-between gap-x-2 bg-gray-200 p-5">
                            <div class="flex items-center gap-x-2 mb-3 md:mb-0">
                                <p class="font-semibold text-xs md:text-lg">Numéro de réservation :
                                    <span><?php echo $reservation->getNumReser(); ?></span>
                                </p>
                            </div>
                            <div class="font-semibold mb-3 md:mb-0">
                                <p class="font-semibold text-xs md:text-lg">Statut de paiement :
                                    <span><?php echo $reservation->getPaymentStatus(); ?></span>
                                </p>
                            </div>

                            <div class="font-semibold">
                                <p class="font-semibold text-xs md:text-lg"> Statut de réservation :
                                    <span><?php echo $reservation->getStatus(); ?></span>
                                </p>
                            </div>
                        </div>

                        <div class="md:flex md:justify-between items-center gap-x-2 py-3 px-5 text-xs md:text-base">
                            <div class="mb-3 md:mb-0">
                                <p class="font-semibold">Conducteur :</p>
                                <span class="font-semibold"><?php echo $reservation->getUsername(); ?></span>
                            </div>

                            <div class="mb-3 md:mb-0">
                                <p class="font-semibold"> Voiture :</p>
                                <div class="flex items-center gap-x-2 ">
                                    <p class="font-semibold"><?php echo $reservation->getBrand(); ?></p>
                                    <p class="font-semibold"><?php echo $reservation->getModel(); ?></p>
                                    <p class="font-semibold"><?php echo $reservation->getColor(); ?></p>
                                </div>
                            </div>

                            <div>
                                <p class="font-semibold"> Statut du covoiturage :</p>
                                <div class="flex items-center gap-x-2 ">
                                    <p class="font-semibold"><?php echo $reservation->getStatusCarSharing(); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mr-3">
                            <?php $status = $reservation->getStatusCarSharing();
                                    $reservStatus                             = $reservation->getStatus();
                                    if ($reservStatus === "Avis en attente de validation" || $reservStatus === "Note enregistré" || $reservStatus === "En attente de contact") {
                                } elseif ($status === "Programmé") {?>
                                <form method="post">
                                    <input type="hidden" name="tokenDeleteReserva"
                                        value="<?php echo htmlspecialchars($token); ?>">
                                    <input type="hidden" name="idReservation" value="<?php echo $reservation->getId(); ?>">
                                    <input type="hidden" name="seatsReserved"
                                        value="<?php echo $reservation->getNumSeatsBookes(); ?>">
                                    <input type="hidden" name="idCarSharing"
                                        value="<?php echo $reservation->getCarSharingId(); ?>">
                                    <input type="hidden" name="credits" value="<?php echo $reservation->getPrices(); ?>">
                                    <button type="submit" name="deleteReservation" value="deleteReservation"
                                        class="btnCancel px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform bg-gray-300 rounded-lg">Annuler</button>
                                </form>
                            <?php } elseif ($status === "Arrivée à destination") {
                                    $id = $reservation->getId(); ?>
                                <a href="/index.php?controller=car-sharing&action=feedbacks&reservation=<?php echo $id ?>"
                                    class="btnSearch px-6 py-2 text-white font-medium tracking-wide transition-colors duration-300 transform rounded-lg">Donnez
                                    votre avis</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</section>