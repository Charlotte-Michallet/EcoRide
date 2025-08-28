<section id="profilPage" class="mt-5">

    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>


    <!-- Profil info and feedback -->
    <div class="max-w-[85rem] px-4 py-5 sm:px-2 mx-auto">

        <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center lg:justify-between">

            <!-- Info -->
            <div class="container lg:col-span-4 lg:col-start-1 min-h-screen px-6 mx-auto">
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
            <div class="container lg:col-span-4 min-h-screen px-6 mx-auto">
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

            <div class="container lg:col-span-4 min-h-screen px-6 mx-auto">
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
        <!-- End Grid -->
    </div>

    <div>
        <h2 class="mb-2 text-3xl text-gray-800 font-bold lg:text-4xl dark:text-neutral-200">
                        Mes avis
                    </h2>
    </div>
</section>