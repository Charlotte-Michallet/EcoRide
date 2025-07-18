<section class="login">
<div class="m-30 w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md ">
    <div class="px-6 py-4">
        <div class="flex justify-center mx-auto">
            <img class="w-auto h-10 sm:h-15" src="assets/img/logo/form.png" alt="logo">
        </div>

         <h3 class="mt-3 text-xl font-medium text-center text-gray-600">Se connecter</h3>

        <p class="mt-1 text-center text-gray-500">Drive Green Together</p>

        <form>
            <div class="mb-4">
                    <label class="block mb-2 text-sm">Email</label>
                    <input type="text" id="emailRegister" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-blue-400 focus:outline-none" name="emailRegister" placeholder="nom.prénom@gmail.com" aria-label="email"/>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm">Mot de passe</label>
                        <input type="password" id="pwdRegister" class="block w-full px-5 py-3 mt-2 border border-gray-200 rounded-lg focus:border-blue-400 focus:outline-none" name="pwdRegister" placeholder="8+ caractères, majuscule, chiffre" />
                    </div>


                    <div class="flex items-center justify-end mt-4">
                        <button class="px-6 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                            Se connecter
                        </button>
                    </div>
        </form>
    </div>

    <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
        <span class="text-sm text-gray-600 dark:text-gray-200">Vous n'avez pas de compter. Créer en un!</span>

        <a href="http://localhost:8080/index.php?controller=auth&action=register" class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline">Inscription</a>
    </div>
</div>

</section>
