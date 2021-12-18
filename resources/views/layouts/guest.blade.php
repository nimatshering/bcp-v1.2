<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   
  @include('layouts.partials._head-front')
    <body class="text-gray-800 antialiased">
      <main>
        <div class="font-sans">
          {{ $slot }}
        </div>
      </main>
      <x-front.footer />  
    </body>
      @stack('modals')
      @livewireScripts
       @stack('scripts')
</html>
