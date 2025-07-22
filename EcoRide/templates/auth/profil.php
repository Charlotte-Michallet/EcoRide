<section class="mt-5">
    <!-- Page title -->

    <h1 class="mt-2 text-2xl font-semibold md:text-3xl">Profil</h1>

    <!-- pages -->
    <div class="flex overflow-x-auto overflow-y-hidden border-b border-gray-200 whitespace-nowrap">
        <button class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-blue-600 bg-transparent border-b-2 border-blue-500 sm:px-4 -px-1  whitespace-nowrap focus:outline-none">Creer voyage </button>

        <button class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:px-4 -px-1  whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400"> Gere ses trajets</button>

        <button class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:px-4 -px-1 dark:text-white whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400">Historique</button>
    </div>


    <!-- Profil info and feedback -->
    <div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 lg:py-14 mx-auto">

        <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center lg:justify-between">

            <!-- Info -->
            <div class="container lg:col-span-5 lg:col-start-1 min-h-screen px-6 mx-auto">
                <div class="w-full max-w-md">

                    <div class="flex items-center justify-center mt-6">
                        <a href="#" class="w-1/3 pb-4 font-medium text-center text-gray-500 capitalize border-b dark:border-gray-400 dark:text-gray-300">
                            modifier compte
                        </a>

                        <a href="#" class="w-1/3 pb-4 font-medium text-center text-gray-800 capitalize border-b-2 border-blue-500 dark:border-blue-400 dark:text-white">
                            supimer compte
                        </a>
                    </div>

                    <h2 class="mb-2 text-3xl text-gray-800 font-bold lg:text-4xl dark:text-neutral-200">
                        Profil
                    </h2>

                    <div class="flex flex-col items-center mt-8">
                        <p class="block w-full py-3 text-gray-700"> Pseudo: <?= $user->getUsername() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Email: <?= $user->getEmail() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Date de naissance: <?= $user->getDateOfBirth() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Credits: <?= $user->getCredits() ?></p>
                        <p class="block w-full py-3 text-gray-700"> Role: <?= $user->getRole()  ?></p>
                        <p class="block w-full py-3 text-gray-700"> Permis: <?= $user->getDriversLicense() ?></p>
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