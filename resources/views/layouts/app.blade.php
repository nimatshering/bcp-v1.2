<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  
@include('layouts.partials._head')

 <body class="font-sans antialiased">
  <section class="my-2">
    <div x-data="{ sidebarOpen: false}">
      <div class="flex min-h-screen flex-grow">
          @can('is-admin')
            <x-admin.sidebar /> 
          @endcan

          @can('is-agency')
            <x-agency.sidebar />            
          @endcan

        <!-- Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
          <div class="flex items-center space-x-4 lg:space-x-0">
            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
              <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </button>
          </div>
          <main class="flex-1 overflow-x-hidden overflow-y-auto flex-grow">
              <x-admin.navbar />
            {{ $slot }}
          </main>
        </div>
      </div>
    </div>
  </section>
    @include('layouts.partials._scripts')
    @stack('modals')
    @livewireScripts
    @stack('scripts')
</body>
</html>
  
   