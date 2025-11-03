<section class="mt-5">
    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-2xl font-semibold text-center text-gray-800 lg:text-3xl">
           Les covoiturages qui se sont mal passés
        </h1>

        <p class="max-w-2xl mx-auto mt-6 text-center text-gray-500">
            Voici les covoiturages qui se sont mal passés
        </p>

        <div class="mx-auto mt-8 xl:mt-10 max-w-7xl">

            <?php foreach ($feedbacks as $feedback) {?>
                <div class="p-6 bg-gray-100 rounded-lg my-8">
                    <div class="flex justify-between">
                        <h2 class="font-semibold">Notes et avis des passagers</h2>
                        <p>Numéro de réservation : <span><?php echo $feedback->getNumberReser() ?></span> </p>
                    </div>

                    <div class="flex justify-between mt-2">
                        <div>
                            <?php $note = $feedback->getNote();
                                if ($note) {?>
                                <p class="leading-loose"><?php echo $feedback->getNote() ?>/5 étoiles</p>
                            <?php } else {
                                }?>

                            <?php if (method_exists($feedback, "getFeedback")) {?>
                                <p class="leading-loose"><?php echo $feedback->getFeedback() ?></p>
                            <?php }?>

                            <div class="flex items-center mt-3">
                                <img class="object-cover rounded-full w-10 h-10"
                                    src="<?php echo $feedback->getPassengersPhoto() ?>" alt="passager photo">

                                <div class="mx-4">
                                    <h2 class="font-semibold"><?php echo $feedback->getPassengersUsername() ?></h2>
                                </div>

                                <div class="mx-4">
                                    <h3 class="font-semibold">Email :
                                        <span><?php echo $feedback->getPassengersEmail() ?></span></h3>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="font-semibold">Voyage effectué le <span><?php echo $feedback->getDepartureDate() ?></span> à
                                <span><?php echo $feedback->getDepartureHour() ?></span>
                            </p>
                            <p class="font-semibold">De <span><?php echo $feedback->getDepartureCity() ?></span> à
                                <span><?php echo $feedback->getArrivalCity() ?>
                            </p>
                            <p class="font-semibold">Numéro de covoiturage :
                                <span><?php echo $feedback->getCarSharingId() ?></span>
                            </p>
                        </div>

                        <div>
                            <p class="font-semibold">Prix : <span><?php echo $feedback->getTotalPrice() ?></span> Crédits
                            </p>
                            <p class="font-semibold">Nombre de places réservées :
                                <span><?php echo $feedback->getNumPlaces() ?></span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-7">
                        <h2 class="font-semibold">Conducteur : </h2>
                        <div class="flex justify-between">
                            <div class="flex items-center mt-2">

                                <img class="object-cover rounded-full w-10 h-10"
                                    src="<?php echo $feedback->getDriverPhoto() ?>" alt="Conducteur photo">

                                <div class="mx-4">
                                    <h3 class="font-semibold"><?php echo $feedback->getDriverUsername() ?></h3>
                                </div>

                                <div class="mx-4">
                                    <h3 class="font-semibold">Email : </h3>
                                    <h3 class="font-semibold"><?php echo $feedback->getDriverEmail() ?></h3>
                                </div>
                            </div>

                            <?php $status = $feedback->getStatus();
                                if ($status === "En attente de contact" || $status = "En attente de validation") {?>
                                <div class="items-center mt-2">
                                    <p>Quand vous aurez résolu le différend, vous pourrez payer le conducteur</p>
                                    <div class="flex justify-center mt-3">
                                        <form method="post">
                                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token) ?>">
                                            <input type="hidden" name="idreservation"
                                                value="<?php echo $feedback->getReservationId() ?>">
                                                 <input type="hidden" name="idfeedback"
                                                value="<?php echo $feedback->getId() ?>">
                                            <button name="driverPayment" value="driverPayment"
                                                class="btnCancel px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform rounded-lg">Payer
                                                le conducteur</button>
                                        </form>
                                    </div>
                                </div>
                            <?php } else {
                                }?>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>

        <h2 class="text-2xl font-semibold text-center text-gray-800 lg:text-3xl">
           Les covoiturages qui se sont mal passés et ont été résolus
        </h2>
        <div class="mx-auto mt-8 xl:mt-10 max-w-7xl">

            <?php foreach ($Resolvedfeeds as $Resolvedfeed) {?>
                <div class="p-6 bg-gray-100 rounded-lg my-8">
                    <div class="flex justify-between">
                        <h2 class="font-semibold">Notes et avis des passagers</h2>
                        <p>Numéro de réservation : <span><?php echo $Resolvedfeed->getNumberReser() ?></span> </p>
                    </div>

                    <div class="flex justify-between mt-2">
                        <div>
                            <?php $note = $Resolvedfeed->getNote();
                                if ($note) {?>
                                <p class="leading-loose"><?php echo $Resolvedfeed->getNote() ?>/5 étoiles</p>
                            <?php } else {
                                }?>

                            <?php if (method_exists($Resolvedfeed, "getFeedback")) {?>
                                <p class="leading-loose"><?php echo $Resolvedfeed->getFeedback() ?></p>
                            <?php }?>

                            <div class="flex items-center mt-3">
                                <img class="object-cover rounded-full w-10 h-10"
                                    src="<?php echo $Resolvedfeed->getPassengersPhoto() ?>" alt="passager photo">

                                <div class="mx-4">
                                    <h2 class="font-semibold"><?php echo $Resolvedfeed->getPassengersUsername() ?></h2>
                                </div>

                                <div class="mx-4">
                                    <h3 class="font-semibold">Email :
                                        <span><?php echo $Resolvedfeed->getPassengersEmail() ?></span></h3>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="font-semibold">Voyage effectué le <span><?php echo $Resolvedfeed->getDepartureDate() ?></span> à
                                <span><?php echo $Resolvedfeed->getDepartureHour() ?></span>
                            </p>
                            <p class="font-semibold">De <span><?php echo $Resolvedfeed->getDepartureCity() ?></span> à
                                <span><?php echo $Resolvedfeed->getArrivalCity() ?>
                            </p>
                            <p class="font-semibold">Numéro de covoiturage :
                                <span><?php echo $Resolvedfeed->getCarSharingId() ?></span>
                            </p>
                        </div>

                        <div>
                            <p class="font-semibold">Prix : <span><?php echo $Resolvedfeed->getTotalPrice() ?></span> Crédits
                            </p>
                            <p class="font-semibold">Nombre de places réservées :
                                <span><?php echo $Resolvedfeed->getNumPlaces() ?></span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-7">
                        <h2 class="font-semibold">Conducteur : </h2>
                        <div class="flex justify-between">
                            <div class="flex items-center mt-2">

                                <img class="object-cover rounded-full w-10 h-10"
                                    src="<?php echo $Resolvedfeed->getDriverPhoto() ?>" alt="Conducteur photo">

                                <div class="mx-4">
                                    <h3 class="font-semibold"><?php echo $Resolvedfeed->getDriverUsername() ?></h3>
                                </div>

                                <div class="mx-4">
                                    <h3 class="font-semibold">Email : </h3>
                                    <h3 class="font-semibold"><?php echo $Resolvedfeed->getDriverEmail() ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</section>