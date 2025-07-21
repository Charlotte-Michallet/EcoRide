<section class="login mt-5">
    <div class="m-13 w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md ">
        <div class="px-6 py-4">
            <div class="flex justify-center mx-auto">
                <img class="w-auto h-10 sm:h-15" src="assets/img/logo/logo.png" alt="logo">
            </div>

            <h3 class="mt-3 text-xl font-medium text-center text-gray-600">Se connecter</h3>

            <p class="mt-1 text-center text-gray-500">Drive Green Together</p>

            <form method="post">
                <div class="mb-4">
                    <label class="block mb-2 text-sm">Email</label>
                    <input type="text" id="emailLogin" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" name="emailLogin" placeholder="nom.prénom@gmail.com" aria-label="email" />
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-sm">Mot de passe</label>
                    <input type="password" id="pwdLogin" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-emerald-500 focus:outline-none" name="pwdLogin" placeholder="8+ caractères, majuscule, chiffre" />
                </div>

                <input type="hidden" name="token_csrf" value="<?= htmlspecialchars($token) ?>">
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class=" btn px-6 py-2 text-sm text-white font-medium tracking-wide capitalize transition-colors duration-300 transform rounded-lg"> Se connecter </button>
                </div>
            </form>
        </div>

        <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
            <span class="text-sm text-gray-600 dark:text-gray-200">Vous n'avez pas de compter. Créer en un!</span>

            <a href="http://localhost:8080/index.php?controller=auth&action=register" class="link mx-2 text-sm font-bold">Inscription</a>
        </div>
    </div>

</section>