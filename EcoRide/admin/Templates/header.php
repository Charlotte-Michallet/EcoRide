<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- favicon -->
  <link rel="shortcut icon" href="<?php ROOT_PATHS?>/../assets/img/logo/form.png" type="image/x-icon">

  <!-- links for tailwind -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <!-- linl leaflet.js -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <!-- Leaflet routing machine -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>


  <!-- css link -->
  <link rel="stylesheet" href="assets/css/overridecss.css">

  <!-- link JavaScript -->

  <script type="module" src="assets/javascript/index.js"></script>

  <title>EcoRide Admin</title>
</head>

<body>
  <!-- Header -->
<header
  class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-48 w-full bg-white border-b border-gray-200 text-sm py-2.5 lg:ps-65">
  <nav class="px-4 sm:px-6 flex basis-full items-center w-full mx-auto">

    <div class="w-full flex items-center justify-end ms-auto md:justify-between gap-x-1 md:gap-x-3">
      <div class="flex flex-row items-center justify-end gap-1">
        <button type="button"
          class="md:hidden size-9.5 relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
          </svg>
          <span class="sr-only">Search</span>
        </button>

        <button type="button"
          class="size-9.5 relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
          </svg>
          <span class="sr-only">Notifications</span>
        </button>

        <button type="button"
          class="size-9.5 relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
          </svg>
          <span class="sr-only">Activity</span>
        </button>

      </div>
    </div>
    <?php if (isset($_SESSION["username"])) {?>

            <div class="flex items-center gap-x-6">
              <a href="/index.php?controller=auth&action=profil"><img class="object-cover w-9 h-9 rounded-full" src="<?php echo $_SESSION["photo"] ?>" alt="profil pic"></a>

              <a
                class="btn bg-teal-500 block rounded-md px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700"
                href="/admin/config/logout.php">
                Déconnexion
              </a>

            </div>
            <?php }?>
  </nav>
</header>
<main>
