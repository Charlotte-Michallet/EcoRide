<section id="modifyProfilPage" class="mt-5">

    <div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center lg:justify-between">
            <div class="container lg:col-span-5 min-h-screen px-6 mx-auto">
                <h2 class="text-2xl font-semibold tracking-wider">Modifier mon profil</h2>

                <div class="grid grid-cols-1 mt-1 gap-6 md:grid-cols-4">
                    <!-- Username -->
                    <form method="post" id="formUsername" class="col-span-2 flex">
                        <div>
                            <label for="username" class="block mb-2 text-sm">Modifier le nom d’utilisateur</label>
                            <input type="text" id="username"
                                class="px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none"
                                name="username" placeholder="Prénom" />
                            <p class="hidden text-xs text-red-600 mt-2" id="usernameError"></p>
                            <input type="hidden" id="tokenUser" value="<?php echo htmlspecialchars($token) ?>">
                            <button type="submit"
                                class="btn flex items-center justify-between px-6 py-3 text-sm text-white transition-colors duration-300 transform rounded-lg">Modifier le nom d’utilisateur</button>
                        </div>
                    </form>

                    <!-- Email -->
                    <form method="post" id="formEmail" class="col-span-2 flex">
                        <div>
                            <label for="email" class="block mb-2 text-sm">Modifier l'e-mail</label>
                            <input type="text" id="email"
                                class="px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none"
                                name="email" placeholder="nom.prénom@gmail.com" />
                            <p class="hidden text-xs text-red-600 mt-2" id="emailError"></p>
                            <input type="hidden" id="tokenEmail" value="<?php echo htmlspecialchars($token) ?>">
                            <button type="submit"
                                class="btn flex items-center justify-between px-6 py-3 text-sm text-white transition-colors duration-300 transform rounded-lg">Modifier
                                l'e-mail</button>
                        </div>
                    </form>


                    <!-- Photo -->
                    <form method="post" id="formPhoto" class="col-span-4 flex">
                        <div>
                            <img id="prevue" class="object-cover w-12 h-12 rounded-full" src="/assets/img/user.jpg"
                                alt="profil pic"></a>
                        </div>
                        <div>
                            <label for="photo" class="block mb-2 text-sm ">Ajouter une photo</label>
                            <input type="file"
                                class=" block w-full px-4 py-2 mt-2 border border-gray-200 rounded-md focus:ring-emerald-500 focus:ring-opacity-10 focus:outline-none focus:ring"
                                id="photo" accept="image/png, image/jpeg, image/jpg" />
                            <p class="hidden text-xs text-red-600 mt-2" id="photoError"></p>
                            <input type="hidden" id="tokenPhoto" value="<?php echo htmlspecialchars($token) ?>">
                            <button type="submit"
                                class="btn flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white transition-colors duration-300 transform rounded-lg md:col-start-1">Ajouter
                                une photo</button>
                        </div>
                    </form>

                    <!-- Password -->
                    <form method="post" id="formpassword" class="col-span-4">
                        <div>
                            <label for="passwordModif" class="block mb-2 text-sm">Modifier le mot de passe</label>
                            <div class="relative">
                                <input type="password" id="passwordModif"
                                    class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none"
                                    name="passwordModif" placeholder="8+ caractères, majuscule, chiffre" />
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
                            <p class="hidden text-xs text-red-600 mt-2" id="passwordError"></p>
                        </div>

                        <div>
                            <label for="ConfPwd" class="block mb-2 text-sm">Confirmation de mot de passe</label>
                            <div class="relative">
                                <input type="password" id="ConfPwd"
                                    class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none"
                                    name="ConfPwd" placeholder="Retapez votre mot de passe" />
                                <span id="toggleV" class="absolute inset-y-3 right-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </span>
                                <p class="hidden text-xs text-red-600 mt-2" id="FormError"></p>
                            </div>
                        </div>
                        <div class="col-span-2 flex">
                            <input type="hidden" id="tokenPwd" value="<?php echo htmlspecialchars($token) ?>">
                            <button type="submit"
                                class="btn flex items-center justify-between px-6 py-3 text-sm tracking-wide text-white transition-colors duration-300 transform rounded-lg md:col-start-1">Modifier
                                le mot de passe</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- preference -->
            <div class="container lg:col-span-5 min-h-screen px-6 mx-auto">
                <h2 class="text-2xl font-semibold tracking-wider">Ajouter ou modifier mes préférences </h2>
                <div class="mt-6">
                    <h3 class="text-gray-800">Selectionner votre préférences</h3>
                </div>

                <form class="grid grid-cols-1 mt-1 gap-6 md:grid-cols-2" method="post" id="formPreferences">
                    <div class="col-span-2">
                        <h2 class="text-gray-800">Animaux acceptés</h2>
                        <fieldset class="flex justify-between">
                            <legend class="sr-only">Animaux acceptés</legend>

                            <div>
                                <label for="acceptAnimal"
                                    class="flex items-center justify-between gap-4 rounded border border-gray-300 p-3 text-sm font-medium shadow-sm transition-colors hover:bg-gray-50 has-checked:ring-1 has-checked:ring-emerald-500">
                                    <p class="text-gray-700">Oui</p>
                                    <input type="radio" name="animalsAllowed" value="acceptAnimal" id="acceptAnimal"
                                        class="sr-only" />
                                </label>
                            </div>

                            <div>
                                <label for="noAnimals"
                                    class="flex items-center justify-between gap-4 rounded border border-gray-300 p-3 text-sm font-medium shadow-sm transition-colors hover:bg-gray-50 has-checked:ring-1 has-checked:ring-emerald-500">
                                    <p>Non</p>
                                    <input type="radio" name="animalsAllowed" value="noAnimals" id="noAnimals"
                                        class="sr-only" />
                                </label>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-span-2">
                        <h2 class="text-gray-800">Fumeur accepté</h2>
                        <fieldset class="flex justify-between">
                            <legend class="sr-only">Fumeur accepté</legend>

                            <div>
                                <label for="smoking"
                                    class="flex items-center justify-between gap-4 rounded border border-gray-300 p-3 text-sm font-medium shadow-sm transition-colors hover:bg-gray-50 has-checked:ring-1 has-checked:ring-emerald-500">
                                    <p class="text-gray-700">Oui</p>
                                    <input type="radio" name="allowedSmoking" value="smoking" id="smoking"
                                        class="sr-only" />
                                </label>
                            </div>

                            <div>
                                <label for="noSmoking"
                                    class="flex items-center justify-between gap-4 rounded border border-gray-300 p-3 text-sm font-medium shadow-sm transition-colors hover:bg-gray-50 has-checked:ring-1 has-checked:ring-emerald-500">
                                    <p>Non</p>
                                    <input type="radio" name="allowedSmoking" value="noSmoking" id="noSmoking"
                                        class="sr-only" />
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    <input type="hidden" id="tokenPreferences" value="<?php echo htmlspecialchars($token) ?>">
                    <p class="hidden text-xs text-red-600 mt-2" id="preferencesError"></p>
                    <button type="submit"
                        class="btn flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white transition-colors duration-300 transform rounded-lg md:col-start-1">Valider</button>
                </form>

                <form class="grid grid-cols-1 mt-1 gap-6 md:grid-cols-2" method="post" id="formotherPreferences">
                    <div>
                        <label for="otherPreferences" class="block mb-2 text-sm">Mes préférences</label>
                        <textarea name="otherPreferences" id="otherPreferences"
                            class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none"></textarea>
                        <p class="hidden text-xs text-red-600 mt-2" id="otherPreferencesError"></p>
                    </div>
                    <input type="hidden" name="token_csrf" id="tokenpreference"
                        value="<?php echo htmlspecialchars($token) ?>">
                    <button type="submit"
                        class="btn flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white transition-colors duration-300 transform rounded-lg md:col-start-1">Valider
                        mes préférences</button>
                </form>
                <p class="hidden text-green-600 mt-2" id="succes"></p>
                </div>
            </div>
        </div>
</section>