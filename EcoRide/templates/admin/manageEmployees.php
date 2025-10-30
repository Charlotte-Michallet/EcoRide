<section id="employeeAccountAdmin">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden">
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">
                                    Tous les employés
                                </h2>
                            </div>
                            <div class="inline-flex gap-x-2">

                                <div id="modal"
                                    class="btn py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white ">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Créer un compte employé
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                Nom d’utilisateur
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
                                                Credits
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                Statut
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs font-semibold uppercase text-gray-800">
                                                Supprimer
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-end"></th>
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
                                                        <span
                                                            class="text-sm text-gray-600"><?php echo $employee->getUsername(); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $employee->getEmail(); ?></span>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="text-sm text-gray-600"><?php echo $employee->getCredits(); ?></span>
                                            </div>
                                        </td>

                                        <?php $active = $employee->getActive();
                                            if ($active === "Suspendu") {?>

                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" viewBox="0 0 16 16">
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
                                                        <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                        </svg>
                                                        Actif
                                                    </span>
                                                </div>
                                            </td>
                                        <?php }?>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                               <form method="post">
                                                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token) ?>">
                                                        <input type="hidden" name="id" value="<?php echo $employee->getId(); ?>">
                                                        <button type="submit" name="delete" value="delete">Supprimer</button>
                                                    </form>
                                            </div>
                                        </td>

                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <?php $active = $employee->getActive();
                                                    if ($active === "Suspendu") {?>
                                                    <form method="post">
                                                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token) ?>">
                                                        <input type="hidden" name="id" value="<?php echo $employee->getId(); ?>">
                                                        <button type="submit" name="activate" value="activate">Activer</button>
                                                    </form>
                                                <?php } else {?>
                                                     <form method="post">
                                                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token) ?>">
                                                        <input type="hidden" name="id" value="<?php echo $employee->getId(); ?>">
                                                        <button type="submit" name="suspend" value="suspend">Suspendre</button>
                                                    </form>
                                                <?php }?>
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
                                    <span class="font-semibold text-gray-800"><?php echo $totalEmplyees ?> </span>
                                    employés
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="employeeModal" class="hidden bg-gray-500/50 size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto"
        role="dialog" tabindex="-1">
        <div id="employeeoverlay"
            class="hidden hs-overlay-open:mt-7  hs-overlay-open:duration-500 mt-5 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="bg-white border border-gray-200 rounded-xl shadow-2xs">
                <div class="p-4 sm:p-7">
                    <div class="text-center">
                        <h3 id="hs-modal-signup-label" class="block text-2xl font-bold ">Créer un compte employé</h3>
                    </div>

                    <!-- Form -->
                    <form id="employeeForm" method="post">
                        <div class="grid gap-y-4">

                            <div>
                                <label for="username" class="block text-sm mb-2">Nom d’utilisateur</label>
                                <input type="text" id="username" name="username"
                                    class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none"
                                    aria-describedby="brandrror" placeholder="Prénom">
                                <p class="hidden text-xs text-red-600 mt-2" id="usernameError"></p>
                            </div>

                            <div>
                                <label for="email" class="block text-sm mb-2">Email</label>
                                <input type="text" id="email" name="email"
                                    class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none"
                                    aria-describedby="modelerror" placeholder="nom.prenom@gmail.com">
                                <p class="hidden text-xs text-red-600 mt-2" id="emailError"></p>
                            </div>

                            <div>
                                <label for="dateOfBirth" class="block text-sm mb-2">Date de naissance</label>
                                <input type="date" id="dateOfBirth" name="dateOfBirth"
                                    class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none"
                                    aria-describedby="modelerror">
                                <p class="hidden text-xs text-red-600 mt-2" id="dobError"></p>
                            </div>

                            <div>
                                <label for="passwordInput" class="block mb-2 text-sm">Mot de passe</label>
                                <div class="relative">
                                    <input type="password" id="passwordInput"
                                        class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none"
                                        name="passwordInput" placeholder="8+ caractères, majuscule, chiffre" />
                                    <span id="toggleVisibility" class="absolute inset-y-3 right-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </span>
                                </div>
                                <p class="hidden text-xs text-red-600 mt-2" id="pwdError"></p>
                            </div>

                            <div>
                                <label for="ConfPwdR" class="block mb-2 text-sm">Confirmation de mot de passe</label>
                                <div class="relative">
                                    <input type="password" id="ConfPwdR"
                                        class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none"
                                        name="ConfPwdR" placeholder="Retapez votre mot de passe" />
                                    <span id="toggleV" class="absolute inset-y-3 right-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </span>
                                    <p class="hidden text-xs text-red-600 mt-2" id="formError"></p>
                                </div>
                            </div>

                            <input type="hidden" id="tokenCsrf" name="tokenCsrf"
                                value="<?php echo htmlspecialchars($token) ?>">
                                <div class="flex justify-between">
                                    <button type="button" id="closeModal"
                            class="btn py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white">Annuler</button>
                                                    <button id="Create" type="submit"
                                class="btn py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-white">Créer
                                le compte</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>