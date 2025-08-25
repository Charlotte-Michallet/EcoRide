<section id="feedback">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="grid md:grid-cols-2 items-center gap-12">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 sm:text-4xl lg:text-5xl lg:leading-tight">
                    Donnez votre avis
                </h1>
                <p class="mt-1 md:text-lg text-gray-800">
                    On peux vous aidez a ameliorer lexperience.
                </p>

                <div class="mt-8">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Le trajet du                                                                                 <?php echo $reservation->getDepartureDate() ?>
                        </h2>
                        <h3>Numéro reservations :                                                                                                     <?php echo $reservation->getNumReser() ?></h3>
                    </div>


                    <ul class="mt-2 space-y-2">
                        <li class="flex gap-x-3">
                            <span>                                                                     <?php echo $reservation->getDepartCity() ?></span> ->
                            <span><?php echo $reservation->getArriCity() ?></span>
                        </li>
                        <li class="flex gap-x-3">
                            <?php echo $reservation->getTotalprice() ?> Crédits
                        </li>

                        <li class="flex gap-x-3">
                            Nom du chauffeur :                                                                                             <?php echo $reservation->getUsername() ?>
                        </li>

                        <li class="flex gap-x-3">
                            Heure de départ :                                                                                             <?php echo $reservation->getDepartHour() ?>
                        </li>

                        <li class="flex gap-x-3">
                            Voiture : <span><?php echo $reservation->getBrand() ?></span> /
                            <span><?php echo $reservation->getModel() ?></span> /
                            <span><?php echo $reservation->getColor() ?></span>
                        </li>
                        <li class="flex gap-x-3">
                            Type d'énergie :                                                                                           <?php echo $reservation->getEnergie() ?>
                        </li>

                        <li class="flex gap-x-3">
                            Nombre de places réserver :                                                                                                                 <?php echo $reservation->getNumSeatsBookes() ?>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="relative">
                <div class="flex flex-col border border-gray-200 rounded-xl p-4 sm:p-6 lg:p-10">
                    <h2 class="text-xl font-semibold text-gray-800">
                        Remplissez le formulaire pour donnez votre avis
                    </h2>

                    <form>
                        <div class="mt-6 grid gap-4 lg:gap-6">

                            <!-- Rating -->
                            <div class="flex flex-row-reverse justify-end items-center">
                                <input id="5stars" type="radio"
                                    class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                    name="notes" value="5">
                                <label for="5stars"
                                    class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                        </path>
                                    </svg>
                                </label>

                                <input id="4stars" type="radio"
                                    class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                    name="notes" value="4">
                                <label for="4stars"
                                    class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                        </path>
                                    </svg>
                                </label>

                                <input id="3stars" type="radio"
                                    class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                    name="notes" value="3">
                                <label for="3stars"
                                    class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                        </path>
                                    </svg>
                                </label>

                                <input id="2stars" type="radio"
                                    class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                    name="notes" value="2">
                                <label for="2stars"
                                    class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                        </path>
                                    </svg>
                                </label>

                                <input id="1star" type="radio"
                                    class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                    name="notes" value="1">
                                <label for="1star"
                                    class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                        </path>
                                    </svg>
                                </label>
                            </div>
                            <!-- End Rating -->

                            <div>
                                <label for="feedbackTextArea"
                                    class="block mb-2 text-sm text-gray-700 font-medium">Commentaire</label>
                                <textarea id="feedbackTextArea" name="feedbackTextArea" rows="4"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"></textarea>
                                <p class="hidden text-green-600 mt-2" id="sendSuccess"></p>
                                <p class="hidden text-xs text-red-600 mt-2" id="feedbackError"></p>
                            </div>
                        </div>
                        <div class="mt-6 grid">
                            <input type="hidden" name="token" id="token" value="<?php echo htmlspecialchars($token) ?>">
                            <input type="hidden" name="reservationId" id="reservationId"
                                value="<?php echo $reservation->getId() ?>">

                            <button type="submit"
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Envoyer
                                votre avis </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>