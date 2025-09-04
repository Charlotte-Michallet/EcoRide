<section>
    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden">
                        <div
                            class="px-6 py-4 grid gap-2 md:flex md:justify-start md:items-center border-b border-gray-200">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">
                                    Toutes les transactions
                                </h2>
                            </div>
                        </div>

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                               N° Transaction
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-4 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                               Statut de paiement pour l’entreprise
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-4 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                Prix pour l’entreprise
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-4 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                Date de la transaction
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-3 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                N° réservation
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-4 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                Statut de paiement de la réservation
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-4 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                               N° de places réservées
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-3 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                Prix de la réservation
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-3 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                N° covoiturage
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-4 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                Date du trajet
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-3 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                N° passager
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-3 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                N° conducteur
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-4 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                Ville de départ
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-4 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                Ville d’arrivée
                                            </span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <?php foreach ($transactions as $transaction) {?>
                                    <tr>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-4 py-3">
                                                <div class="flex items-center gap-x-2">
                                                    <span
                                                        class="text-sm text-gray-600"><?php echo $transaction["transactionID"]; ?></span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-4 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $transaction["companyPayment"]["status"]; ?></span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-4 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $transaction["companyPayment"]["price"]; ?>
                                                    Crédits</span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-4 py-3">
                                                <span class="text-sm text-gray-600">
                                                    <?php echo $dateCompany; ?>
                                                </span>
                                            </div>
                                        </td>

                                        <?php ?>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-3 py-3">
                                                <span class="text-sm text-gray-600">
                                                    <?php echo $transaction["tripDetails"]["reservationID"]; ?>
                                                </span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-4 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $transaction["tripDetails"]["paymentTripStatus"]; ?></span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-3 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $transaction["tripDetails"]["seatsBooked"]; ?></span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-4 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $transaction["tripDetails"]["totalprice"]; ?>
                                                    Crédits</span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-3 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $transaction["tripDetails"]["carSharingID"]; ?></span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-4 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $dateTrip; ?></span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-3 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $transaction["tripDetails"]["passengerID"]; ?></span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-3 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $transaction["tripDetails"]["driverId"]; ?></span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-4 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $transaction["tripDetails"]["departureCity"]; ?></span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-4 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $transaction["tripDetails"]["arrivalCity"]; ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>

                        <!-- Footer -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-start md:items-center border-t border-gray-200">
                            <div>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800"><?php echo $numTransaction ?></span>
                                   Nombre total de transactions
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>