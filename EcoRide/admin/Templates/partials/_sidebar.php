<div class="sticky top-0 inset-x-0 z-20 border-y border-gray-200 px-4 sm:px-6 lg:px-8 lg:hidden">
  <div class="flex items-center py-2">
    <!-- Breadcrumb -->
    <ol class="ms-3 flex items-center whitespace-nowrap">
      <li class="flex items-center text-sm text-gray-800">
        Application Layout
        <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400" width="16" height="16" viewBox="0 0 16 16"
          fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" />
        </svg>
      </li>
      <li class="text-sm font-semibold text-gray-800 truncate" aria-current="page">
        Dashboard
      </li>
    </ol>
    <!-- End Breadcrumb -->
  </div>
</div>
<!-- End Breadcrumb -->

<!-- Sidebar -->
<div id="hs-application-sidebar" class="hs-overlay  [--auto-close:lg]
  hs-overlay-open:translate-x-0
  -translate-x-full transition-all duration-300 transform
  w-65 h-full
  hidden
  fixed inset-y-0 start-0 z-60
  bg-white border-e border-gray-200
  lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
 " role="dialog" tabindex="-1" aria-label="Sidebar">
  <div class="relative flex flex-col h-full max-h-full">
    <div class="px-6 pt-4 flex items-center">
      <!-- Logo -->
        <img class="w-auto h-10 sm:h-15" src="<?php ROOT_PATHS?>/../assets/img/logo/logo.png" alt="logo">
    </div>

    <!-- Content -->
    <div
      class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
      <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul class="flex flex-col space-y-1">
          <li>
            <a class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100"
              href="/admin/index.php?controller=pages&action=dashboard">
              Dashboard
            </a>
          </li>

           <li>
            <a class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100"
              href="/admin/index.php?controller=pages&action=dashboard">
              Utilisateurs
            </a>
          </li>

           <li>
            <a class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100"
              href="/admin/index.php?controller=pages&action=dashboard">
              Compte employée
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </div>
</div>
