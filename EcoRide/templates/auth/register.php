<section id="registerPage" class="m-5">
    <div class="flex justify-center">
        <div class="hidden bg-cover lg:block lg:w-2/5">
            <img src="/assets/img/cercle-personnes.png" alt="groupe en cercle" class="w-100 h-130">
        </div>

        <div class="flex w-full max-w-3xl px-8 mx-auto lg:px-12 lg:w-3/5">
            <div class="w-full">
                <h1 class="text-2xl font-semibold tracking-wider capitalize">
                    Créer votre compte des maintenant
                </h1>
                <a href="/index.php?controller=auth&action=login">
                    <p class="mt-1 text-sm text-gray-500">Déjà un compte! Connectez vous</p>
                </a>

                <div class="mt-6">
                    <h2 class="text-gray-800">Selectionner votre statut</h2>
                </div>

                <form class="grid grid-cols-1 mt-1 gap-6 md:grid-cols-2" method="post">

                    <div class="col-span-2">

                        <fieldset class="flex justify-between">
                            <legend class="sr-only">Role utilisateur</legend>

                            <div>
                                <label for="driverAndPassengerR" class="flex items-center justify-between gap-4 rounded border border-gray-300 p-3 text-sm font-medium shadow-sm transition-colors hover:bg-gray-50 has-checked:ring-1 has-checked:ring-emerald-500">
                                    <p class="text-gray-700">Conducteur et passager</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <input type="radio" name="userRolesRegister" value="driverAndPassengerR" id="driverAndPassengerR" class="sr-only"/>
                                </label>
                            </div>

                            <div>
                                <label for="driverR" class="flex items-center justify-between gap-4 rounded border border-gray-300 p-3 text-sm font-medium shadow-sm transition-colors hover:bg-gray-50 has-checked:ring-1 has-checked:ring-emerald-500">
                                    <p>Conducteur</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <input type="radio" name="userRolesRegister" value="driver" id="driverR" class="sr-only" />
                                </label>
                            </div>

                            <div>
                                <label for="passengerR" class="flex items-center justify-between gap-4 rounded border border-gray-300 p-3 text-sm font-medium shadow-sm transition-colors hover:bg-gray-50 has-checked:ring-1 has-checked:ring-emerald-500" ><p>Passager</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <input type="radio" name="userRolesRegister" value="passenger" id="passengerR"  class="sr-only" />
                                </label>
                            </div>

                        </fieldset>
                    </div>

                    <div>
                        <label for="usernameRegister" class="block mb-2 text-sm">Pseudo</label>
                        <input type="text" id="usernameRegister" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500  focus:outline-none" name="usernameRegister" placeholder="Prénom" />
                         <p class="hidden text-xs text-red-600 mt-2" id="usernameError"></p>
                    </div>

                    <div>
                        <label for="emailRegister" class="block mb-2 text-sm">Email</label>
                        <input type="text" id="emailRegister" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" name="emailRegister" placeholder="nom.prénom@gmail.com" />
                         <p class="hidden text-xs text-red-600 mt-2" id="emailError"></p>
                    </div>

                    <div>
                        <label for="dateBirthR" class="block mb-2 text-sm">Date de naissance</label>
                        <input type="date" id="dateBirthR" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" name="dateBirthR" />
                         <p class="hidden text-xs text-red-600 mt-2" id="dobError"></p>
                    </div>

                    <div>
                        <label for="pwdRegister" class="block mb-2 text-sm">Mot de passe</label>
                        <div class="relative">
                            <input type="password" id="pwdRegister" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" name="pwdRegister" placeholder="8+ caractères, majuscule, chiffre" />
                            <span id="toggleVisibility" class="absolute inset-y-3 right-3" >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            </span>
                        </div>

                        <p class="hidden text-xs text-red-600 mt-2" id="pwdError"></p>
                    </div>

                    <div>
                        <label for="ConfPwdR" class="block mb-2 text-sm">Confirmation de mot de passe</label>
                        <div class="relative">
                            <input type="password" id="ConfPwdR" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" name="ConfPwdR" placeholder="Retapez votre mot de passe" />
                            <span id="toggleV" class="absolute inset-y-3 right-3" >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            </span>
                            <p class="hidden text-xs text-red-600 mt-2" id="registerFormError"></p>
                        </div>
                    </div>

                    <input type="hidden" name="token_csrf" id="tokenRegister" value="<?php echo htmlspecialchars($token) ?>">


                    <button type="submit"
                        class="btn flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-300 transform rounded-lg md:col-start-1">
                        <span>Inscription</span>

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>