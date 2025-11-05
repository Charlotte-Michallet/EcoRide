<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- favicon -->
  <link rel="shortcut icon" href="assets/img/logo/form.png" type="image/x-icon">

  <!-- links for tailwind -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <!-- link leaflet.js -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <!-- Leaflet routing machine -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>

  <!-- CSS link -->
  <link rel="stylesheet" href="/assets/css/overridecss.css">

  <!-- JavaScript link -->
  <script type="module" src="/assets/javascript/index.js"></script>

  <title><?php echo $meta["title"] ?> </title>
  <meta name="description" content="<?php echo $meta["description"] ?>">
  <?php if (isset($meta["keywords"])) {?>
    <meta name="keywords" content="<?php echo $meta["keywords"] ?>">
  <?php }?>
  <?php if (isset($meta["robots"])) {?>
    <meta name="robots" content="<?php echo $meta["robots"] ?>">
  <?php }?>

</head>

<body>
  <header>
    <div class="flex flex-wrap justify-around items-center gap-8 mx-10 text-gray-900">
      <a href="/index.php">
        <img class="h-20 w-36 object-contain" src="assets/img/logo/logo.png" alt="Ecoride logo">
      </a>
      <div class="flex flex-1 items-center flex-wrap sm:justify-between">
        <nav class="flex flex-wrap">
          <ul class="flex items-center gap-6 text-lg">
            <li>
              <a class="transition hover:text-gray-700/75"
                href="/index.php?controller=car-sharing&action=show">Covoiturage</a>
            </li>

            <li>
              <a class="transition hover:text-gray-500/75" href="/index.php?controller=pages&action=contact">Contact</a>
            </li>

          </ul>
        </nav>
        <div class="flex items-center gap-4 text-lg">

          <?php if (isset($_SESSION["username"])) {?>

            <div class="flex items-center gap-x-6">
              <a href="/index.php?controller=auth&action=profil"><img class="object-cover w-12 h-12 rounded-full"
                  src="<?php echo $_SESSION["photo"] ?>" alt="profil pic"></a>

              <a class="btn block rounded-md px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700"
                href="/conf/logout.php">
                Déconnexion
              </a>

            </div>

          <?php } else {?>
            <div class="flex gap-4">
              <a class="btn block rounded-md px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700"
                href="/index.php?controller=auth&action=login">
                Connexion
              </a>

              <a class="link block rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600 transition hover:text-teal-600/75 "
                href="/index.php?controller=auth&action=register">
                Inscription
              </a>
            </div>
          <?php }?>
        </div>
      </div>
    </div>
  </header>
  <main>