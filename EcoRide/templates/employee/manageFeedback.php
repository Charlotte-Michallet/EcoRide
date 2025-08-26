<section class="mt-5">
    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-2xl font-semibold text-center text-gray-800 lg:text-3xl">
            Avis des passagers sur les covoiturages en attente de validation
        </h1>

        <p class="max-w-2xl mx-auto mt-6 text-center text-gray-500">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo incidunt ex placeat modi magni quia error
            alias, adipisci rem similique, at omnis eligendi optio eos harum.
        </p>

        <div class="mx-auto mt-8 xl:mt-10 max-w-7xl">

            <?php foreach ($feedbacks as $feedback) {?>
                <div class="p-6 bg-gray-100 rounded-lg">
                    <div class="flex justify-between">
                        <h2 class="font-semibold"> Notes et avis passager</h2>
                        <p>Numéro de reservation :                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php echo $feedback->getNumberReser() ?></p>
                    </div>

                    <div class="flex justify-between mt-2">
                        <div>
                            <p class="leading-loose"><?php echo $feedback->getNote() ?>/5 Etoiles</p>
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
                                <span><?php echo $feedback->getNumPlaces() ?></span></p>

                        </div>
                    </div>

                    <div class="leading-loose text-gray-500"></div>

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

                            <div class="flex gap-4">
                                <form method="post">
                                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token) ?>">
                                    <input type="hidden" name="idFeedback" value="<?php echo $feedback->getId() ?>">
                                    <input type="hidden" name="idreservation" value="<?php echo $feedback->getReservationId() ?>">
                                    <input type="hidden" name="idcarsharing" value="<?php echo $feedback->getCarSharingId() ?>">
                                    <button name="refuseFeedback" value="refuseFeedback"
                                        class="px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none">Refuser
                                        avis</button>
                                </form>

                                <form method="post">
                                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token) ?>">
                                    <input type="hidden" name="idFeedback" value="<?php echo $feedback->getId() ?>">
                                    <button name="deleteReservation" value="deleteReservation"
                                        class="px-6 py-2 font-medium tracking-wide text-white transition-colors duration-300 transform bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none">Valider
                                        avis</button>
                                        <!--  -->
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            <?php }?>

        </div>
    </div>
</section>