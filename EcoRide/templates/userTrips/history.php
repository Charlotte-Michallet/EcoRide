<section class="mt-5">
    <?php require_once ROOT_PATH . "/templates/partials/_navProfil.php"?>
    <!-- Card Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Grid -->
        <div class="grid grid-cols-1 gap-4 sm:gap-6">
            <h3>Conducteur :</h3>
            <?php foreach ($trips as $trip) {?>

                <div class="pt-2 border border-gray-200 rounded-xl">
                    <div class="p-4 md:p-5">

                        <div class="flex justify-between gap-x-2 pb-2">
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold">                                                                                                                                                                                                                                                                                                                                                                                                                <?php echo $trip->getDepartureDate(); ?></span></p>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold">
                                    <?php echo $trip->getStatus(); ?></span>
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2 pb-2">
                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold"><?php echo $trip->getDepartureCity(); ?></p>
                            </div>
                            <div class="line my-2 mx-6"></div>

                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold"><?php echo $trip->getKilometers(); ?></p>
                            </div>
                             <div class="line my-2 mx-6"></div>

                            <div class="flex items-center gap-x-2">
                                <p class="font-semibold"><?php echo $trip->getArrivalCity(); ?></p>
                            </div>
                        </div>


                        <div class="flex justify-between gap-x-2 px-5 pb-3">
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold"><?php echo $trip->getDepartureHour(); ?></p>
                            </div>

                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold"><?php echo $trip->getTravel_time(); ?></p>
                            </div>

                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold"><?php echo $trip->getArrivalTime(); ?></p>
                            </div>
                        </div>

                        <div class="flex justify-between gap-x-2">
                            <div class="flex items-center gap-x-2 ">
                                <p class="font-semibold">Places disponible : <span><?php echo $trip->getNumSeats(); ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
        <p>Passager:</p>
    </div>
</section>