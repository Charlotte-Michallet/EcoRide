<section id="profilPage" class="mt-5 min-h-9/10">
    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>

    <div class="max-w-[85rem] px-4 py-5 sm:px-2 mx-auto">
        <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-start lg:items-center lg:justify-between mt-5">

            <!-- Info -->
            <div class="container lg:col-span-4 lg:col-start-1 min-h-1/2 px-6 mx-auto">
                <div class="w-full max-w-md">
                    <h2 class="mb-2 text-3xl text-gray-800 font-bold lg:text-4xl">
                        Mon profil
                    </h2>

                    <div class="flex flex-col items-center mt-8">
                        <p class="block w-full py-3 text-gray-700"> Pseudo
                            <?php echo " : " . htmlspecialchars($user->getUsername()) ?>
                        </p>
                        <p class="block w-full py-3 text-gray-700"> Email
                            <?php echo " : " . htmlspecialchars($user->getEmail()); ?>
                        </p>
                        <p class="block w-full py-3 text-gray-700"> Date de
                            naissance<?php echo " : " . htmlspecialchars($user->getDateOfBirth()); ?></p>
                        <p class="block w-full py-3 text-gray-700">
                            Credits<?php echo " : " . htmlspecialchars($user->getCredits()); ?></p>
                        <p class="block w-full py-3 text-gray-700"> Role
                            <?php echo " : " . htmlspecialchars($user->getRole()); ?>
                        </p>
                    </div>

                </div>
            </div>

            <!-- Preferences -->
            <div class="container lg:col-span-4 min-h-1/2 px-6 mx-auto">
                <div class="w-full max-w-md">
                    <h2 class="mb-2 text-3xl text-gray-800 font-bold lg:text-4xl">
                        Mes préferences
                    </h2>

                    <div class="flex flex-col items-center mt-8">
                        <p class="block w-full py-3 text-gray-700"> Animal
                            acepter<?php echo " : " . htmlspecialchars($preferences["animal"]); ?> </p>
                        <p class="block w-full py-3 text-gray-700"> Fumer
                            acepeter<?php echo " : " . htmlspecialchars($preferences["smoking"]); ?></p>
                        <p class="block w-full py-3 text-gray-700"> Mes autre
                            preferences<?php echo " : " . htmlspecialchars($preferences["descriptif"]); ?></p>
                    </div>

                </div>
            </div>

            <div class="container lg:col-span-4 min-h-1/2 px-6 mx-auto">
                <?php if ($_SESSION["role"] !== 1) {?>
                    <div class="sm:flex sm:gap-4 w-full">

                        <a class="btn block rounded-md px-4 py-3 content-center font-medium text-white transition hover:bg-teal-700"
                            href="/index.php?controller=auth&action=profilModify">
                            Modifier compte
                        </a>

                        <form method="post"
                            class="link rounded-md bg-gray-100 px-4 py-3 font-medium text-teal-600 transition hover:text-teal-600/75 sm:block">
                            <input type="hidden" name="tokenProfil" id="tokenProfil"
                                value="<?php echo htmlspecialchars($token) ?>">
                            <button type="submit" name="deleteProfil" value="deleteProfil" class="content-center">Supprimer
                                compte </button>
                        </form>
                    </div>
                <?php } else {?>
                    <div class="flex justify-center">

                        <a class="btn block rounded-md px-4 py-3 content-center font-medium text-white transition hover:bg-teal-700"
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
                                <p class="font-semibold">Voyage le
                                    <span><?php echo $allfeedback->getDepartureDate() ?></span> à
                                    <span><?php echo $allfeedback->getDepartureHour() ?></span>
                                </p>
                                <p class="font-semibold">De <span><?php echo $allfeedback->getDepartureCity() ?></span> à
                                    <span><?php echo $allfeedback->getArrivalCity() ?>
                                </p>
                            </div>

                            <div>
                                <p class="font-semibold">Prix : <span><?php echo $allfeedback->getTotalPrice() ?></span>
                                    Crédits
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
                                        <h3 class="font-semibold">Status de l'avis :
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