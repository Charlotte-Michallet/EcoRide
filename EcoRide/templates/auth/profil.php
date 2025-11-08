<section class="mt-5 min-h-9/10">
    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <div class="max-w-[85rem] px-4 py-5 sm:px-2 mx-auto">
        <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-start lg:items-center lg:justify-between mt-5">

            <!-- Info -->
            <div class="container lg:col-span-4 lg:col-start-1 min-h-1/2 px-6 mx-auto mb-6 lg:mb-0">
                <div class="w-full max-w-md">
                    <h2 class="text-3xl text-gray-800 font-bold lg:text-4xl">
                        Mon profil
                    </h2>

                    <div class="flex flex-col items-center mt-8">
                        <p class="block w-full py-3 text-gray-700 font-medium"> Nom d’utilisateur <span class="font-normal">
                                <?php echo " : " . htmlspecialchars($user->getUsername()) ?></span>
                        </p>

                        <p class="block w-full py-3 text-gray-700 font-medium"> Email <span class="font-normal">
                                <?php echo " : " . htmlspecialchars($user->getEmail()); ?></span>
                        </p>

                        <p class="block w-full py-3 text-gray-700 font-medium"> Date de
                            naissance <span
                                class="font-normal"><?php echo " : " . htmlspecialchars($user->getDateOfBirth()); ?></span>
                        </p>
                        <p class="block w-full py-3 text-gray-700 font-medium">
                            Crédits <span
                                class="font-normal"><?php echo " : " . htmlspecialchars($user->getCredits()); ?></span>
                        </p>
                        <p class="block w-full py-3 text-gray-700 font-medium"> Rôle <span
                                class="font-normal"><?php echo " : " . htmlspecialchars($user->getRole()); ?></span>
                        </p>
                        <p class="block w-full py-3 text-gray-700 font-medium"> Notes <span
                                class="font-normal"><?php echo " : " . $user->getNotes(); ?></span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Preferences -->
            <div class="container lg:col-span-4 min-h-1/2 px-6 mx-auto mb-5 lg:mb-0">
                <div class="w-full max-w-md">
                    <h2 class="text-3xl text-gray-800 font-bold lg:text-4xl">
                       Mes préférences
                    </h2>

                    <div class="flex flex-col items-center mt-8">
                        <p class="block w-full text-gray-700 font-medium"> Animaux acceptés
                            <span
                                class="font-normal"><?php echo " : " . htmlspecialchars($preferences["animal"]); ?></span>
                        </p>
                        <p class="block w-full py-3 text-gray-700 font-medium"> Fumeurs acceptés <span
                                class="font-normal"><?php echo " : " . htmlspecialchars($preferences["smoking"]); ?></span>
                        </p>
                        <p class="block w-full py-3 text-gray-700 font-medium"> Mes autres préférences
                            <span class="font-normal">
                                <?php echo " : " . htmlspecialchars($preferences["descriptif"]); ?></span>
                        </p>
                    </div>

                </div>
            </div>

            <div class="container lg:col-span-4 px-6 mx-auto">
                <?php if ($_SESSION["role"] !== 1) {?>
                    <div class="flex flex-wrap sm:gap-4">

                        <a class="btn rounded-md px-4 py-3 m-2 lg:m-0 text-center font-medium text-white transition hover:bg-teal-700"
                            href="/index.php?controller=auth&action=profilModify">
                            Modifier compte
                        </a>

                        <form method="post"
                            class="link rounded-md bg-gray-100 px-4 py-3 m-2 lg:m-0 font-medium text-teal-600 transition hover:text-teal-600/75 ">
                            <input type="hidden" name="tokenProfil" id="tokenProfil"
                                value="<?php echo htmlspecialchars($token) ?>">
                            <button type="submit" name="deleteProfil" value="deleteProfil" class="content-center">Supprimer
                                compte </button>
                        </form>
                    </div>
                <?php } else {?>
                    <div class="flex justify-center">

                        <a class="btn rounded-md px-4 py-3 text-center font-medium text-white transition hover:bg-teal-700"
                            href="/index.php?controller=auth&action=profilModify">
                            Modifier compte
                        </a>

                    </div>
                <?php }?>
            </div>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center lg:justify-between mt-5">
            <div class="container lg:col-span-12 lg:col-start-1 px-6 mx-auto min-h-1/2">
                <h2 class="mb-2 text-3xl text-gray-800 font-bold lg:text-4xl">
                    Mes avis
                </h2>

                <?php foreach ($feedbacks as $allfeedback) {?>
                    <div class="p-6 bg-gray-100 rounded-lg my-8">
                        <div class="flex flex-wrap justify-between">
                            <div>
                                <h2 class="font-semibold"> Notes et avis passager</h2>
                                <p>Numéro de réservation : <span><?php echo $allfeedback->getNumberReser() ?></span></p>
                            </div>

                            <div class="mt-4 md:mt-0">
                                <p>Le covoiturage s’est bien passé : <span><?php echo $allfeedback->getTripWell() ?></span></p>
                            </div>
                        </div>

                        <div class="flex flex-wrap justify-between mt-2">
                            <div>
                                <p class="leading-loose"><?php echo $allfeedback->getNote() ?>/5 étoiles</p>

                                <p class="leading-loose">
                                    <?php echo $allfeedback->getFeedback() ?>
                                </p>
                            </div>

                            <div class="mt-4 md:mt-0">
                                <p class="font-semibold mx-4">Voyage effectué le
                                    <span><?php echo $allfeedback->getDepartureDate() ?></span>
                                </p>
                                <p class="font-semibold mx-4">A
                                    <span><?php echo $allfeedback->getDepartureHour() ?></span> -
                                    <span><?php echo $allfeedback->getArrivalHour() ?></span></p>
                                <p class="font-semibold mx-4">De <span><?php echo $allfeedback->getDepartureCity() ?></span> à
                                    <span><?php echo $allfeedback->getArrivalCity() ?>
                                </p>
                            </div>

                            <div class="mt-4 md:mt-0">
                                <p class="font-semibold mx-4">Prix : <span><?php echo $allfeedback->getTotalPrice() ?></span>
                                    Crédits
                                </p>
                                <p class="font-semibold mx-4">Nombre de places réservées :
                                    <span><?php echo $allfeedback->getNumPlaces() ?></span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-7">
                            <h2 class="font-semibold">Conducteur : </h2>
                            <div class="flex flex-wrap justify-between">
                                <!-- flex flex-wrap justify-between mt-2 -->
                                <div class="flex items-center mt-2">

                                    <img class="object-cover rounded-full w-10 h-10"
                                        src="<?php echo $allfeedback->getDriverPhoto() ?>" alt="Profil conducteur">

                                    <div class="mx-4">
                                        <h3 class="font-semibold"><?php echo $allfeedback->getDriverUsername() ?></h3>
                                    </div>
                                </div>

                                <div class="flex items-center mt-2">
                                    <div class="mx-4">
                                        <h3 class="font-semibold">Statut de l’avis :
                                            <span><?php echo $allfeedback->getStatus(); ?></span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</section>