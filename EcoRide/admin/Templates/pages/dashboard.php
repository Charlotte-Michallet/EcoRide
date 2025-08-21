<?php require_once "Templates/partials/_sidebar.php"?>

<section >
  <!-- id="dashboard" -->

<!-- Content -->
<div class="w-full lg:ps-64">
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
              92,913
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
              Nombre de covoiturage pas Jours
            </h2>
            <p class="text-xl sm:text-2xl font-medium text-gray-800">
              $126,238.49
            </p>
          </div>

          <div>
            <span
              class="py-[5px] px-1.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-md bg-teal-100 text-teal-800">
              <svg class="inline-block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M12 5v14" />
                <path d="m19 12-7 7-7-7" />
              </svg>
              25%
            </span>
          </div>
        </div>


        <div id="hs-multiple-bar-charts"></div>
      </div>

      <div class="p-4 md:p-5 min-h-102.5 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
        <div class="flex flex-wrap justify-between items-center gap-2">
          <div>
            <h2 class="text-sm text-gray-500">
                Credit par jous
            </h2>
            <p class="text-xl sm:text-2xl font-medium text-gray-800">
              80.3k
            </p>
          </div>

          <div>
            <span
              class="py-[5px] px-1.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-md bg-red-100 text-red-800">
              <svg class="inline-block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M12 5v14" />
                <path d="m19 12-7 7-7-7" />
              </svg>
              2%
            </span>
          </div>
        </div>

        <div id="hs-single-area-chart"></div>
      </div>
    </div>

    <!-- Card -->
    <div class="flex flex-col">
      <div
        class="overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300">
        <div class="min-w-full inline-block align-middle">
          <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
              <div>
                <h2 class="text-xl font-semibold text-gray-800">
                  Users
                </h2>
                <p class="text-sm text-gray-600">
                  Add users, edit and more.
                </p>
              </div>

              <div>
                <div class="inline-flex gap-x-2">
                  <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50"
                    href="#">
                    View all
                  </a>

                  <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                    href="#">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round">
                      <path d="M5 12h14" />
                      <path d="M12 5v14" />
                    </svg>
                    Add user
                  </a>
                </div>
              </div>
            </div>


            <!-- Employés -->
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800">
                        Nom
                      </span>
                    </div>
                  </th>

                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800">
                        Prénom
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

                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase text-gray-800">
                        Compte
                      </span>
                    </div>
                  </th>

                  <th scope="col" class="px-6 py-3 text-end"></th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-200">
                <tr>

                  <td class="size-px whitespace-nowrap">
                    <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                      <div class="flex items-center gap-x-3">
                        <img class="inline-block size-9.5 rounded-full"
                          src="https://images.unsplash.com/photo-1531927557220-a9e23c1e4794?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                          alt="Avatar">
                        <div class="grow">
                          <span class="block text-sm font-semibold text-gray-800">Christina Bersh</span>
                          <span class="block text-sm text-gray-500">christina@site.com</span>
                        </div>
                      </div>
                    </div>
                  </td>

                  <td class="h-px w-72 whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span class="block text-sm font-semibold text-gray-800">Director</span>
                      <span class="block text-sm text-gray-500">Human resources</span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span
                        class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full">
                        <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                          fill="currentColor" viewBox="0 0 16 16">
                          <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                        Active
                      </span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <div class="flex items-center gap-x-3">
                        <span class="text-xs text-gray-500">1/5</span>
                        <div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
                          <div class="flex flex-col justify-center overflow-hidden bg-gray-800" role="progressbar"
                            style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span class="text-sm text-gray-500">28 Dec, 12:12</span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-1.5">
                      <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium"
                        href="#">
                        Edit
                      </a>
                    </div>
                  </td>
                </tr>

              </tbody>
            </table>
            <!-- End Table -->

            <!-- Footer -->
           <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
              <div>
                <p class="text-sm text-gray-600">
                  <span class="font-semibold text-gray-800">12</span> results
                </p>
              </div>

              <div>
                <div class="inline-flex gap-x-2">
                 <p>qsf</p>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
</div>
<!-- End Content -->

</section>
