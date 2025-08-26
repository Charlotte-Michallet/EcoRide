<section id="dashboard">

  <!-- Content -->
  <div class="w-full px-20">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
      <!-- Grid -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase text-gray-500">
                Utilisateur total
              </p>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
                <?php echo $statistiques["users"] ?>
              </h3>
            </div>
          </div>
        </div>

        <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase text-gray-500">
                Employées total
              </p>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
                <?php echo $statistiques["employees"] ?>
              </h3>
            </div>
          </div>
        </div>

        <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase text-gray-500">
                Nombre de covoiturage total
              </p>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
                <?php echo $statistiques["totalTrips"] ?>
              </h3>
            </div>
          </div>
        </div>

        <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
          <div class="p-4 md:p-5">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase text-gray-500">
                Credit de la plateforme
              </p>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
               <?php echo $statistiques["totalcredits"] ?> Crédits
              </h3>
            </div>
          </div>
        </div>
      </div>
      <!-- End Grid -->

      <!-- graphiques -->
      <div class="grid lg:grid-cols-2 gap-4 sm:gap-6">
        <div class="p-4 md:p-5 min-h-102.5 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">

          <div class="flex flex-wrap justify-between items-center gap-2">
            <div>
              <h2 class="text-sm text-gray-500">
                Nombre de covoiturage aujourd'hui
              </h2>
              <p class="text-xl sm:text-2xl font-medium text-gray-800">
                <?php echo $statistiques["tripPerDays"] ?>
              </p>
            </div>
          </div>

          <div class="flex h-full justify-center items-center p-4">
            <canvas class="h-9/10 w-9/10 m-2" id="graphTrip"></canvas>
          </div>
        </div>

        <div class="p-4 md:p-5 min-h-102.5 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
          <div class="flex flex-wrap justify-between items-center gap-2">
            <div>
              <h2 class="text-sm text-gray-500">
               Nombre de credit aujourd'hui
              </h2>
              <p class="text-xl sm:text-2xl font-medium text-gray-800">
                <?php echo $statistiques["tripPerDays"] ?>
              </p>
            </div>
          </div>

          <div class="flex h-full justify-center items-center">
            <canvas class=" h-9/10 w-9/10" id="graphCredit"></canvas>
          </div>
        </div>
      </div>

      <!-- Employés -->
      <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="flex flex-col">
          <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
              <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden">
                <!-- Header -->
                <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                  <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                      Tous les employés
                    </h2>
                  </div>
                  <div class="inline-flex gap-x-2">

                    <a href="/admin/index.php?controller=manage&action=employees"
                      class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                      <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                      </svg>
                      Créer un compte employé
                    </a>
                  </div>
                </div>

                <!-- Table -->
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                          <span class="text-xs font-semibold uppercase text-gray-800">
                            Pseudo
                          </span>
                        </div>
                      </th>

                      <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                          <span class="text-xs font-semibold uppercase text-gray-800">
                            Email
                          </span>
                        </div>
                      </th>

                      <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                          <span class="text-xs font-semibold uppercase text-gray-800">
                            credits
                          </span>
                        </div>
                      </th>

                      <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                          <span class="text-xs font-semibold uppercase text-gray-800">
                            Status
                          </span>
                        </div>
                      </th>
                    </tr>
                  </thead>

                  <tbody class="divide-y divide-gray-200">
                    <?php foreach ($employees as $employee) {?>
                      <tr>
                        <td class="size-px whitespace-nowrap">
                          <div class="px-6 py-3">
                            <div class="flex items-center gap-x-2">
                              <img class="inline-block w-10 h-9 rounded-full"
                                src="<?php echo $employee->getPhotoUrl(); ?>" alt="Avatar">
                              <div class="grow">
                                <span class="text-sm text-gray-600"><?php echo $employee->getUsername(); ?></span>
                              </div>
                            </div>
                          </div>
                        </td>

                        <td class="size-px whitespace-nowrap">
                          <div class="px-6 py-3">
                            <span class="text-sm text-gray-600"><?php echo $employee->getEmail(); ?></span>
                          </div>
                        </td>

                        <td class="size-px whitespace-nowrap">
                          <div class="px-6 py-3">
                            <span class="text-sm text-gray-600"><?php echo $employee->getCredits(); ?></span>
                          </div>
                        </td>

                        <?php $active = $employee->getActive();
                            if ($active === "Suspendu") {?>

                          <td class="size-px whitespace-nowrap">
                            <div class="px-6 py-3">
                              <span
                                class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                  fill="currentColor" viewBox="0 0 16 16">
                                  <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                  </path>
                                </svg>
                                Suspendu
                              </span>
                            </div>
                          </td>

                        <?php } else {?>
                          <td class="size-px whitespace-nowrap">
                            <div class="px-6 py-3">
                              <span
                                class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full">
                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                  fill="currentColor" viewBox="0 0 16 16">
                                  <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>
                                Actif
                              </span>
                            </div>
                          </td>
                        <?php }?>
                      </tr>
                    <?php }?>
                  </tbody>
                </table>

                <!-- Footer -->
                <div class="px-6 py-4 grid gap-3 md:flex md:justify-start md:items-center border-t border-gray-200">
                  <div>
                    <p class="text-sm text-gray-600">
                      <span class="font-semibold text-gray-800"><?php echo $statistiques["totalEmployees"] ?> </span>
                      employées
                    </p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- End Content -->
</section>