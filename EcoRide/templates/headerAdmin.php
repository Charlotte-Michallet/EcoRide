<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- favicon -->
  <link rel="shortcut icon" href="/assets/img/logo/form.png" type="image/x-icon">

  <!-- links for tailwind -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <!-- link Chart.js -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- css link -->
  <link rel="stylesheet" href="/assets/css/overridecss.css">

  <!-- link JavaScript -->
  <script type="module" src="assets/javascript/index.js"></script>

  <title><?php echo $meta["title"] ?> </title>
  <meta name="description" content="<?php echo $meta["description"] ?>">
  <meta name="robots" content="<?php echo $meta["robots"] ?>">

</head>

<body>
  <header>
    <div class="flex justify-around items-center gap-8 mx-10 text-gray-900">

      <div class="block">
        <img class="w-auto h-5 lg:h-10" src="/assets/img/logo/logo.png" alt="logo">
      </div>
      <?php if (isset($_SESSION["username"]) && $_SESSION["role"] === 1) {?>
      <div class="flex flex-1 items-center justify-end md:justify-between">
        <nav class=" text-xs lg:text-sm">
          <ul class="flex items-center gap-6 ">
            <li>
              <a class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5  text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100"
                href="/index.php?controller=admin&action=dashboard">
                Dashboard
              </a>
            </li>

            <li>
              <a class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100"
                href="/index.php?controller=admin&action=users">
                Utilisateurs
              </a>
            </li>

            <li>
              <a class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100"
                href="index.php?controller=admin&action=employees">
                Comptes employés
              </a>
            </li>

            <li>
              <a class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100"
                href="index.php?controller=admin&action=transactions">
                Reçus de transactions
              </a>
            </li>

          </ul>
        </nav>
        <div class="flex items-center gap-4 text-lg">
            <div class="flex items-center gap-x-6">
              <a href="/index.php?controller=admin&action=profil"><img class="object-cover w-5 h-5 lg:w-9 lg:h-9 rounded-full"
                  src="<?php echo htmlspecialchars($_SESSION["photo"]) ?>" alt="profil pic"></a>

              <a class="btn bg-teal-500 block rounded-md px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700 text-xs"
                href="/conf/logout_admin.php">
                Déconnexion
              </a>

            </div>

        </div>
      </div>
      <?php } else {?>
    <?php }?>
    </div>
  </header>
  <main>