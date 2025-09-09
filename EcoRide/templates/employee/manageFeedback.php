<section class="mt-5">
    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-2xl font-semibold text-center text-gray-800 lg:text-3xl">
            Avis des passagers sur les covoiturages en attente de validation
        </h1>

        <p class="max-w-2xl mx-auto mt-6 text-center text-gray-500">
            Voici les note et avis des passagers
        </p>

        <div class="mx-auto mt-8 xl:mt-10 max-w-7xl">

            <?php foreach ($feedbacks as $feedback) {?>
                <div class="p-6 bg-gray-100 rounded-lg my-8">
                    <div class="flex justify-between">
                        <h2 class="font-semibold"> Notes et avis passager</h2>
                        <p>Numéro de reservation : <span><?php echo $feedback->getNumberReser() ?></span></p>
                    </div>
                    <div>
                        <p>Covoiturage c'est bien passé : <span><?php echo $feedback->getTripWell() ?></span></p>
                    </div>

                    <div class="flex justify-between mt-2">
                        <div>
                            <?php $note = $feedback->getNote();
                                if ($note) {?>
                                <p class="leading-loose"><?php echo $feedback->getNote() ?>/5 Etoiles</p>
                            <?php } else {
                                }?>
                            <p class="leading-loose">
                                <?php echo $feedback->getFeedback() ?>
                            </p>

                            <div class="flex items-center mt-3">
                                <img class="object-cover rounded-full w-10 h-10"
                                    src="<?php echo $feedback->getPassengersPhoto() ?>" alt="passager photo">

                                <div class="mx-4">
                                    <h2 class="font-semibold"><?php echo $feedback->getPassengersUsername() ?></h2>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="font-semibold">Voyage le <span><?php echo $feedback->getDepartureDate() ?></span> à
                                <span><?php echo $feedback->getDepartureHour() ?></span>
                            </p>
                            <p class="font-semibold">De <span><?php echo $feedback->getDepartureCity() ?></span> à
                                <span><?php echo $feedback->getArrivalCity() ?>
                            </p>
                        </div>

                        <div>
                            <p class="font-semibold">Prix : <span><?php echo $feedback->getTotalPrice() ?></span> Crédits
                            </p>
                            <p class="font-semibold">Nombre de place reserver :
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
                            </div>
                            <?php $feedbackStatus = $feedback->getStatus();
                                if ($feedbackStatus === "En attente de validation") {?>
                                <div class="flex gap-4">
                                    <form method="post">
                                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token) ?>">
                                        <input type="hidden" name="idFeedback" value="<?php echo $feedback->getId() ?>">
                                        <input type="hidden" name="idreservation" value="<?php echo $feedback->getReservationId() ?>">
                                        <button name="refuseFeedback" value="refuseFeedback"
                                            class="px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none">Refuser
                                            avis</button>
                                    </form>

                                    <form method="post">
                                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token) ?>">
                                        <input type="hidden" name="idFeedback" value="<?php echo $feedback->getId() ?>">
                                        <input type="hidden" name="idreservation" value="<?php echo $feedback->getReservationId() ?>">
                                        <input type="hidden" name="noteFeedback" value="<?php echo $feedback->getNote() ?>">
                                        <button name="validateFeedback" value="validateFeedback"
                                            class="px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none">Valider
                                            avis</button>
                                    </form>
                                </div>
                            <?php } else {
                                }?>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>

        <div class="mx-auto mt-8 xl:mt-10 max-w-7xl">
            <div>
                <h2 class="text-2xl font-semibold text-center text-gray-800 lg:text-3xl">
           Tous les avis des covoiturages
        </h2>

            </div>
            <?php foreach ($allfeedbacks as $allfeedback) {?>
                <div class="p-6 bg-gray-100 rounded-lg my-8">
                    <div class="flex justify-between">
                        <h2 class="font-semibold"> Notes et avis passager</h2>
                        <p>Numéro de reservation : <span><?php echo $allfeedback->getNumberReser() ?></span></p>
                    </div>
                    <div>
                        <p>Covoiturage c'est bien passé : <span><?php echo $allfeedback->getTripWell() ?></span></p>
                    </div>

                    <div class="flex justify-between mt-2">
                        <div>
                            <?php $note = $allfeedback->getNote();
                                if ($note) {?>
                                <p class="leading-loose"><?php echo $allfeedback->getNote() ?>/5 Etoiles</p>
                            <?php } else {
                                }?>
                            <p class="leading-loose">
                                <?php echo $allfeedback->getFeedback() ?>
                            </p>

                            <div class="flex items-center mt-3">
                                <img class="object-cover rounded-full w-10 h-10"
                                    src="<?php echo $allfeedback->getPassengersPhoto() ?>" alt="passager photo">
                                <div class="mx-4">
                                    <h2 class="font-semibold"><?php echo $allfeedback->getPassengersUsername() ?></h2>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="font-semibold">Voyage le <span><?php echo $allfeedback->getDepartureDate() ?></span> à
                                <span><?php echo $allfeedback->getDepartureHour() ?></span>
                            </p>
                            <p class="font-semibold">De <span><?php echo $allfeedback->getDepartureCity() ?></span> à
                                <span><?php echo $allfeedback->getArrivalCity() ?>
                            </p>
                        </div>

                        <div>
                            <p class="font-semibold">Prix : <span><?php echo $allfeedback->getTotalPrice() ?></span> Crédits
                            </p>
                            <p class="font-semibold">Nombre de place reserver :
                                <span><?php echo $allfeedback->getNumPlaces() ?></span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-7">
                        <h2 class="font-semibold">Conducteur : </h2>
                        <div class="flex justify-between">
                            <div class="flex items-center mt-2">

                                <img class="object-cover rounded-full w-10 h-10"
                                    src="<?php echo $allfeedback->getDriverPhoto() ?>" alt="Conducteur photo">

                                <div class="mx-4">
                                    <h3 class="font-semibold"><?php echo $allfeedback->getDriverUsername() ?></h3>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <div class="mx-4">
                                    <h3 class="font-semibold">Status de l'avis : <span><?php echo $allfeedback->getStatus(); ?></span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</section>