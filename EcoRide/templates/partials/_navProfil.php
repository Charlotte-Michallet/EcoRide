<!-- pages -->
<div class="flex overflow-x-auto overflow-y-hidden border-b border-gray-200 whitespace-nowrap">
    <!-- Page title -->

    <a class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:px-4 -px-1  whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400" href="/index.php?controller=auth&action=profil">
        <h1 >Profil</h1>
    </a>

     <?php if ($_SESSION["role"] === 3 || $_SESSION["role"] === 5 || $_SESSION["role"] === 2) {?>
    <a href="/index.php?controller=auth&action=cars"> <button
            class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:px-4 -px-1 dark:text-white whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400">Mes voitures</button></a>


    <a href="/index.php?controller=trips&action=createTrip"> <button
            class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:px-4 -px-1  whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400">Creer un voyage </button>
        </a>
        <?php }?>

    <a href="/index.php?controller=trips&action=manageTrip"> <button
            class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:px-4 -px-1  whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400">Mes trajets</button>
        </a>

    <a href="/index.php?controller=trips&action=history"> <button
            class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:px-4 -px-1 dark:text-white whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400">Historique</button>
        </a>

        <a href="/index.php?controller=auth&action=credits"> <button
            class="inline-flex items-center h-10 px-2 py-2 -mb-px text-center text-gray-700 bg-transparent border-b-2 border-transparent sm:px-4 -px-1 dark:text-white whitespace-nowrap cursor-base focus:outline-none hover:border-gray-400">Credits</button>
        </a>
</div>
