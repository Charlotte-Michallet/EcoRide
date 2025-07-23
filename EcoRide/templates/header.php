<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- favicon -->
  <link rel="shortcut icon" href="assets/img/logo/form.png" type="image/x-icon">

  <!-- links for tailwind -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <!-- css link -->
  <link rel="stylesheet" href="/assets/css/overridecss.css">

  <!-- link JavaScript -->

  <script type="module" src="/assets/javascript/index.js"></script>

  <title>EcoRide</title>
</head>

<body>
  <header>

    <div class="flex justify-around items-center gap-8 mx-10 text-gray-900">
      <a class="block" href="/index.php">
        <img class="h-20 w-35 object-contain" src="assets/img/logo/logo.png" alt="Ecoride logo">
      </a>
      <div class="flex flex-1 items-center justify-end md:justify-between">
        <nav aria-label="Global" class="hidden md:block">
          <ul class="flex items-center gap-6 text-lg">
            <li>
              <a class="transition hover:text-gray-700/75" href="http://localhost:8080/index.php?controller=car-sharing&action=show">Covoiturage </a>
            </li>

            <li>
              <a class="transition hover:text-gray-500/75" href="http://localhost:8080/index.php?controller=pages&action=contact"> Contact </a>
            </li>

          </ul>
        </nav>

        <div class="flex items-center gap-4 text-lg">

          <?php if (isset($_SESSION["username"])) {?>
            <div class="flex items-center gap-x-6">
              <a href="http://localhost:8080/index.php?controller=auth&action=profil"><img class="object-cover w-12 h-12 rounded-full" src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&h=764&q=100" alt="profil pic"></a>

              <a
                class="btn block rounded-md px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700"
                href="/conf/logout.php">
                Déconnexion
              </a>

            </div>

          <?php } else {?>
            <div class="sm:flex sm:gap-4">
              <a
                class="btn block rounded-md px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700"
                href="http://localhost:8080/index.php?controller=auth&action=login">
                Connexion
              </a>

              <a
                class="link hidden rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600 transition hover:text-teal-600/75 sm:block"
                href="http://localhost:8080/index.php?controller=auth&action=register">
                Inscription
              </a>
            </div>
          <?php }?>
        </div>
      </div>
    </div>
  </header>
  <main>