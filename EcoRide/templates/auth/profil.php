<section id="profilPage" class="mt-5">

    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>


    <!-- Profil info and feedback -->
    <div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 lg:py-14 mx-auto">

        <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center lg:justify-between">

            <!-- Info -->
            <div class="container lg:col-span-5 lg:col-start-1 min-h-screen px-6 mx-auto">
                <div class="w-full max-w-md">

                    <div class="flex items-center justify-center mt-6">
                        <a href="http://localhost:8080/index.php?controller=auth&action=profilModify" class="w-1/3 pb-4 font-medium text-center text-gray-500 capitalize border-b">
                            modifier compte
                        </a>

                        <a href="#" class="w-1/3 pb-4 font-medium text-center text-gray-800 capitalize border-b-2 border-blue-500">
                            supprimer compte
                        </a>
                    </div>

                    <h2 class="mb-2 text-3xl text-gray-800 font-bold lg:text-4xl dark:text-neutral-200">
                        Mon profil
                    </h2>

                    <div class="flex flex-col items-center mt-8">
                        <p class="block w-full py-3 text-gray-700"> Pseudo:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php echo $user->getUsername() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Email:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php echo $user->getEmail() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Date de naissance:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php echo $user->getDateOfBirth() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Credits:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php echo $user->getCredits() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Role:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php echo $user->getRole() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Permis:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php echo $user->getDriversLicense() ?></p>
                    </div>

                </div>
            </div>

            <!-- feedback -->
            <div class="container lg:col-span-5 min-h-screen px-6 mx-auto">
                <div class="w-full max-w-md">


                    <h2 class="mb-2 text-3xl text-gray-800 font-bold lg:text-4xl dark:text-neutral-200">
                        Mes préferences
                    </h2>

                    <div class="flex flex-col items-center mt-8">
                        <p class="block w-full py-3 text-gray-700"> Animal acepter    :                                                                                                                                                                                                                                                                                                                                                    <?php echo $user->getUsername() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Fumer acepeter        :                                                                                                                                                                                                                                                                                                                                                             <?php echo $user->getEmail() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Mes autre preferences           :                                                                                                                                                                                                                                                                                                                                                                                              <?php echo $user->getDateOfBirth() ?></p>

                    </div>

                </div>
            </div>




        </div>
        <!-- End Grid -->
    </div>

</section>