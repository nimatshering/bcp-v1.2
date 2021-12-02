 <header class="relative py-2 bg-deepblue-900">
  <div class="flex flex-wrap absolute top-0 w-full h-full bg-center bg-cover"
    style='background-image: url("{{ asset('assets/img/bg.jpg')}}");'>
    <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
  </div>
  <div class="container mx-auto relative flex flex-wrap justify-center md:justify-between">
      <div class="flex text-white md:w-6/12">
        <div class="hidden md:block">
          <a href="{{ route('landing') }}">
            <img class="h-24" alt="logo" src="{{ asset('assets/img/rgob.png')}}"/>
          </a>
        </div>

        <div class="p-2 text-center">
          <h1 class="font-extrabold uppercase lg:text-3xl">
            Bhutan Climate Platform
          </h1>
          <p class="mt-2 text-white">
              A knowledge base for climate change initatives in Bhutan.
          </p>
        </div>
      </div>

      <div class="md:w-6/12 gap-4">
        <div class="flex justify-end gap-4">
          <a href="{{ route('landing') }}"
              class="bg-yellow-400 hover:bg-yellow-200 shadow-md font-semibold my-4 py-2 px-4 text-gray-900 cursor-pointer rounded text-sm uppercase">
             Home
            </a>

          <a href="{{ route('about') }}"
              class="shadow-md font-semibold my-4 py-2 px-4 text-gray-900 cursor-pointer bg-gray-200  hover:bg-gray-50 rounded text-sm uppercase">
              About
            </a>
            
            <a href="{{ route('contact') }}"
              class="relative shadow-md animate-pulse font-semibold my-4 py-2 px-4 text-gray-900 cursor-pointer bg-green-300 hover:bg-gray-50 rounded
              text-sm uppercase">
              Contact
            </a>
        </div>
      </div>
  </div>
</header>