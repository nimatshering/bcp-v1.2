<!-- main navigation-->
  <nav class="flex flex-wrap items-center justify-between w-full px-2 py-3 bg-white text-green-700 shadow navbar-expand-lg">
    <div class="container flex items-center justify-between mx-auto">
      <a href="{{ route('admin.dashboard')}}">
        <div class="flex flex-wrap space-x-4 items-center">
          <h2 class="text-sm md:text-xl font-extrabold uppercase pl-6">
            National Environment Commission
          </h2>
          <p class="font-dzongkha text-lg md:text-2xl">
           རྒྱལ་ཡོངས་མཐའ་འཁོར་གནས་སྟངས་ལྷན་ཚོགས། 
          </p>
      </div>
      </a>

      <div x-data="{ dropdownOpen: false }" class="relative pr-10">
        <button @click="dropdownOpen = ! dropdownOpen" class="flex items-center space-x-2 relative focus:outline-none">
          <h2 class="hidden sm:block font-bold text-xs uppercase">{{ Auth::user()->name }}</h2>
          <img class="h-9 w-9 rounded-full border-2 border-gray-500 object-cover" src="{{ asset('assets/img/avatar.svg')}}"
            alt="Your avatar">
        </button>

        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10" x-show="dropdownOpen"
          x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform"
          x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
          @click.away="dropdownOpen = false">
          <a href="{{ route('profile.show') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-700">Profile</a>
          <div class="border-t border-gray-100"></div>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-jet-dropdown-link href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-jet-dropdown-link>
            </form>
        </div>
      </div>
    </div>
  </nav>