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
                        Profil
                    </h2>

                    <div class="flex flex-col items-center mt-8">
                        <p class="block w-full py-3 text-gray-700"> Pseudo:                                                                                                                                                       <?php echo $user->getUsername() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Email:                                                                                                                                                     <?php echo $user->getEmail() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Date de naissance:                                                                                                                                                                             <?php echo $user->getDateOfBirth() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Credits:                                                                                                                                                         <?php echo $user->getCredits() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Role:                                                                                                                                                   <?php echo $user->getRole() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Permis:                                                                                                                                                       <?php echo $user->getDriversLicense() ?></p>
                    </div>

                </div>
            </div>

            <!-- feedback -->
            <div class="lg:mt-0 lg:col-span-6 lg:col-end-13">
                <div class="space-y-6 sm:space-y-8">
                    <!-- List -->
                    <ul class="grid grid-cols-2 divide-y divide-y-2 divide-x divide-x-2 divide-gray-200 overflow-hidden dark:divide-neutral-700">
                        <li class="flex flex-col -m-0.5 p-4 sm:p-8">
                            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2 dark:text-neutral-200">
                                45k+
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-neutral-400">
                                users - from new startups to public companies
                            </p>
                        </li>

                        <li class="flex flex-col -m-0.5 p-4 sm:p-8">
                            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2 dark:text-neutral-200">

                                23%
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-neutral-400">
                                increase in traffic on webpages with Looms
                            </p>
                        </li>

                        <li class="flex flex-col -m-0.5 p-4 sm:p-8">
                            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2 dark:text-neutral-200">

                                9.3%
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-neutral-400">
                                boost in reply rates across sales outreach
                            </p>
                        </li>

                        <li class="flex flex-col -m-0.5 p-4 sm:p-8">
                            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2 dark:text-neutral-200">
                                2x
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-neutral-400">
                                faster than previous Preline versions
                            </p>
                        </li>
                    </ul>
                    <!-- End List -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->
    </div>

</section>