<section id="details">
    <div class="container px-6 py-10 mx-auto">
        <div class="flex justify-between">

            <div class="flex justify-between  gap-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="#0754acf3" class="size-10">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                </svg>
                <h2 class="text-2xl font-semibold lg:text-3xl"><?php echo $details->getDepartureDate() ?>
                </h2>
            </div>

            <div class="flex  justify-end ">
                <p class="hidden text-lg text-red-600 mt-2" id="errorDetails"></p>
            </div>
        </div>

        <!-- trip -->
        <div class="flex justify-between mt-6 gap-6">

            <div class="p-6 space-y-3 border-2 border-emerald-600 shadow-xs rounded-xl w-2/3">
                <div>
                    <p class="text-lg font-semibold">Trajet: </p>
                </div>
                <div class="flex justify-between gap-x-2 pb-2">
                    <div class="flex items-center gap-x-2">
                        <p class="text-lg font-semibold"><?php echo $details->getDepartureHour() ?> </p>
                    </div>

                    <div class="lineLeft my-2 ml-4"></div>
                    <div class="flex items-center gap-x-2">
                        <p class="text-lg font-semibold"><?php echo $details->getTravel_time() ?> </p>
                    </div>

                    <div class="lineRight my-2 mr-4"></div>
                    <div class="flex items-center gap-x-2">
                        <p class="text-lg font-semibold"><?php echo $details->getArrivalTime() ?> </p>
                    </div>
                </div>

                <div class="flex justify-between gap-x-2 pb-2">
                    <div class="flex items-center gap-x-2">
                        <p class="text-lg font-semibold"> <span><?php echo $details->getDepartureCity() ?></span></p>
                    </div>

                    <div class="flex items-center gap-x-2">
                        <p class="text-lg font-semibold"><span
                                class="text-lg font-semibold"><?php echo $details->getKilometers() ?></span> km </p>
                    </div>

                    <div class="flex items-center gap-x-2">
                        <p class="text-lg font-semibold"><?php echo $details->getArrivalCity() ?> </p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-3 border-2 border-emerald-600 shadow-xs rounded-xl w-1/3">
                <div>
                    <p class="text-lg font-semibold">Informations sur le trajet: </p>
                </div>
                <div class="flex justify-between">
                    <p class="text-2xl font-semibold"> <span
                            class="text-2xl font-semibold"><?php echo $details->getNumSeats() ?></span> places
                        disponibles
                    </p>

                    <p class="text-3xl font-semibold"> <span id="credits"
                            class="text-3xl font-semibold"><?php echo $details->getPrice() ?></span> Crédits</p>
                </div>

                <div class="flex justify-between">
                    <p class="text-xs font-semibold">* 1 Crédit = 1€</p>
                    <button id="participate"
                        class="btnSearch item-center px-5 py-2 leading-5 text-white transition-colors duration-300 transform rounded-md focus:outline-none">Participer</button>
                </div>

            </div>
        </div>

        <!-- user info -->
        <div class="flex mt-6 ">
            <div class="p-8 space-y-3 border-2 border-emerald-600 shadow-xs rounded-xl w-full">
                <div>
                    <p class="text-lg font-semibold">Chauffeur: </p>
                </div>
                <div class="flex w-full items-center">
                    <div class="flex w-1/2 items-center">
                        <img class="object-cover w-20 h-20 rounded-full mr-9" src="<?php echo $details->getPhoto() ?>"
                            alt="photo profil">
                        <p class="text-xl font-semibold mr-9"><?php echo $details->getUsername() ?></p>

                        <div class="flex items-center text-xl font-semibold">
                            <?php $notes = $details->getNotes();
                            if ($notes !== null) {?>
                                <p class="text-xl font-semibold ml-2">
                                    <span><?php echo $details->getNotes() ?></span>
                                    /5 Étoiles
                                </p>
                            <?php } else {
                            }?>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <p class="text-xl font-semibold">
                            Préférences :
                        </p>
                        <div class="flex gap-6 justify-between mt-3">
                            <div>
                                <p class="text-lg font-semibold">
                                    Animaux autorisés :
                                </p>
                                <p class="text-lg font-semibold">
                                    <?php echo $moreDetails["animal"] ?>
                                </p>
                            </div>

                            <div class="mx-9">
                                <p class="text-lg font-semibold">
                                    Fumeur autorisé :
                                </p>
                                <p class="text-lg font-semibold">
                                    <?php echo $moreDetails["smoking"] ?>
                                </p>
                            </div>
                            <div>
                                <p class="text-lg font-semibold">
                                    <?php echo $moreDetails["descriptif"] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- car info -->
        <div class="flex mt-6">
            <div class="p-8 space-y-3 border-2 border-emerald-600 shadow-xs rounded-xl w-full">
                <div>
                    <p class="text-lg font-semibold">Informations sur la voiture: </p>
                </div>
                <div class="flex w-full items-center">
                    <div class="flex w-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" xml:space="preserve"
                            style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2"
                            width="50" heigth="50">
                            <path
                                d="M44.075 16.488A2.023 2.023 0 0 0 42.124 15H21.876c-.911 0-1.71.609-1.951 1.488L15.667 32h32.666l-4.258-15.512zM52.907 38a6.59 6.59 0 0 0-.379-1.346l-1.353-3.382A2.023 2.023 0 0 0 49.297 32H14.703c-.827 0-1.571.504-1.878 1.272l-1.353 3.382A6.586 6.586 0 0 0 11 39.103v4.873c0 1.118.906 2.024 2.024 2.024H36"
                                style="fill:none;stroke:#0754acf3;stroke-width:2px" />
                            <path
                                d="M11.583 37.583h4.323c.926 0 1.772.523 2.186 1.351l1.075 2.149M16 30.583s-1.691-3.5-3.833-3.5M48.333 30.583s1.691-3.5 3.834-3.5M21.5 46.5h-7v3.68A1.824 1.824 0 0 0 16.32 52h3.36a1.824 1.824 0 0 0 1.82-1.82V46.5zM56 41a3 3 0 0 0-3-3H43a3 3 0 0 0-3 3v7.051a7.5 7.5 0 0 0 4.425 6.841L48 56.5l3.575-1.608A7.5 7.5 0 0 0 56 48.051V41z"
                                style="fill:none;stroke:#0754acf3;stroke-width:2px" />
                            <path d="m44.75 46.748 2.5 2 4-3.5" style="fill:none;stroke:#0754acf3;stroke-width:2px" />
                        </svg>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold mx-2">Marque, modèle et couleur</p>
                            <p class="text-lg font-semibold mx-2">
                                <?php echo $details->getBrand() ?>
                            </p>

                            <p class="text-lg font-semibold mx-2">
                                <?php echo $details->getModel() ?>
                            </p>

                            <p class="text-lg font-semibold mx-2">
                                <?php echo $details->getColor() ?>
                            </p>
                        </div>

                    </div>
                    <div class="flex w-1/2">
                        <p class="text-lg font-semibold mx-2">Énergie de la voiture :
                            <span><?php echo $details->getEnergyTy() ?></span>
                        </p>
                        <p class="mx-2 text-sm">
                            *voyage écologique = voyage en électrique
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- fedbacks -->
        <div class="flex mt-6">
            <div class="p-8 space-y-3 border-2 border-emerald-600 shadow-xs rounded-xl w-full">
                <div>
                    <p class="text-lg font-semibold">Les avis des passagers :</p>
                </div>
                <div class="max-w-[85rem] px-4 py-5 mx-auto">
                    <div class="grid lg:grid-cols-2 lg:gap-y-16 gap-10">
                        <?php foreach ($feedbacks as $feedback) {?>
                            <div class="group block rounded-xl p-3 m-3 shadow-md border border-gray-200 bg-gray-100">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5">
                                    <div class="shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
                                        <img class="object-cover w-10 h-10 rounded-full mr-9"
                                            src="<?php echo $feedback->getPassengersPhoto() ?>" alt="photo profil">
                                        <p class="text font-semibold mx-2">
                                            <?php echo $feedback->getPassengersUsername() ?>
                                        </p>
                                        <p class="text-sm pt-3 font-medium">
                                            Voyage effectué le: <span><?php echo $feedback->getDepartureDate() ?></span>
                                        </p>
                                        <p class="text-sm pt-3 font-medium">
                                            De: <span><?php echo $feedback->getDepartureCity() ?></span> à
                                            <span><?php echo $feedback->getArrivalCity() ?></span>
                                        </p>
                                    </div>

                                    <div class="grow">
                                        <h3 class="text-xl font-semibold">
                                            <span><?php echo $feedback->getNote() ?></span>/5 Étoiles
                                        </h3>
                                        <p class="mt-3 italic font-semibold">
                                            "<span><?php echo $feedback->getFeedback() ?></span>" </p>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div id="modal" class="hidden fixed inset-0 z-50 grid place-content-center bg-black/50 p-4" role="dialog"
        aria-modal="true" aria-labelledby="modalTitre">
        <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg">
            <div class="mt-4">
                <p class="text-pretty text-gray-700">
                    Le trajet coûte <span>                                            <?php echo $totalPrice ?></span> . Êtes-vous sûr de vouloir participer a ce
                    trajet</p>
            </div>

            <div class="flex gap-6">
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" id="cancel"
                        class="rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200">
                        Annuler
                    </button>
                </div>

                <form method="post" class="mt-6 flex justify-end gap-2">
                    <input type="hidden" name="token_Participate" value="<?php echo htmlspecialchars($token) ?>">
                    <input type="hidden" id="creditsUsed" name="creditsUsed" value="<?php echo $totalPrice ?>">
                    <input type="hidden" id="car_sharing_id" name="car_sharing_id"
                        value="<?php echo $details->getId() ?>">
                    <input type="hidden" id="reservation_date" name="reservation_date"
                        value="<?php echo $details->getDepartureDateFormat() ?>">
                    <button type="submit" id="participateBtn" name="participateBtn" value="participateBtn"
                        class="btn rounded px-4 py-2 text-sm font-medium text-white transition-colors ">
                        Participer
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>