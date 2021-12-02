<div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed z-20 inset-0 opacity-50 transition-opacity lg:hidden ">
</div>
  <!-- sidebar -->
  <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed z-30 inset-y-0 left-0 w-80 transition duration-300  transform bg-green-800 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex flex-col sm:flex-row sm:justify-around">
      <div class="w-full mt-6">
           <!--Home -->
        <a href="{{ route('admin.dashboard') }}">
          <h1 class="mx-4 p-4 font-extrabold rounded uppercase text-sm bg-green-600 hover:bg-green-500 text-white py-3 mb-10">
          <i class="fa fa-home pr-2"></i> Home
        </h1>
        </a>
          <!--Water and Climate Settings -->
        <div x-data="{ open: false }" class="py-2 mx-4 font-extrabold">
          <button @click="open = !open" class="rounded bg-green-600 hover:bg-green-500 w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                <i class="fa fa-tint pr-2"></i> Water and Climate Settings
              </span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </span>
          </button>
          <nav class="flex flex-col mx-3 overflow-hidden">
              <div x-show="open" x-on:click.away="open = false" >
                <a class="dropdown-menu-item text-white" href="{{ route('admin.station.types') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Station Types
                </a>
                <a class="dropdown-menu-item text-white" href="{{ route('admin.parameters') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Hydro-Met Parameters
                </a>
                <a class="dropdown-menu-item text-white" href="{{ route('admin.stations') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Stations
                </a>
                <a class="dropdown-menu-item text-white" href="{{ route('admin.grids') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Grids
                </a>
                <a class="dropdown-menu-item text-white" href="{{ route('admin.climate-models') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Models
                </a>
                <a class="dropdown-menu-item text-white" href="{{ route('admin.climate-scenerios') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Scenerios
                </a>
                 <a class="dropdown-menu-item text-white" href="{{ route('admin.statistics') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Statistics
                </a>
              </div>
          </nav>
        </div>

        <!--Disaster Settings -->
        <div x-data="{ open: false }" class="py-2 mx-4 font-extrabold">
          <button @click="open = !open" class="rounded bg-green-600 hover:bg-green-500 w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                <i class="fa fa-exclamation-triangle pr-2"></i> Disaster Settings
              </span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </span>
          </button>
          <nav class="flex flex-col mx-3 overflow-hidden">
              <div x-show="open" x-on:click.away="open = false" >
                <a class="dropdown-menu-item text-white" href="{{ route('admin.disaster.types') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Disaster Types
                </a>
                <a class="dropdown-menu-item text-white" href="{{ route('admin.disaster.parameters') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Disaster Parameters
                </a>
              </div>
          </nav>
        </div>
        
        <!--GHG Settings -->
        <div x-data="{ open: false }" class="py-2 mx-4 font-extrabold">
          <button @click="open = !open" class="rounded bg-green-600 hover:bg-green-500 w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                <i class="fa fa-gas-pump pr-2"></i> GHG Settings
              </span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </span>
          </button>
          <nav class="flex flex-col mx-3 overflow-hidden">
              <div x-show="open" x-on:click.away="open = false" >
                
                 <a class="dropdown-menu-item text-white" href="{{ route('admin.sectors') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Sectors
                </a>
              </div>
          </nav>
        </div>

        <!--Document Management -->
        <div x-data="{ open: false }" class="py-2 mx-4">
          <button @click="open = !open" class="bg-green-600 hover:bg-green-500 rounded w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                <i class="fa fa-book pr-2"></i> Document Category 
              </span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </span>
          </button>
          <nav class="flex flex-col mx-3 overflow-hidden">
              <div x-show="open" x-on:click.away="open = false" >
                <a class="dropdown-menu-item" href="{{ route('admin.climatescience.research.category') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Climate Science and Research 
                </a>
                <a class="dropdown-menu-item text-white" href="{{ route('admin.guidance.category') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Guidance Documensts 
                </a>
                <a class="dropdown-menu-item text-white" href="{{ route('admin.projectprogram.category') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Projects & Programs 
                </a>
              </div>
          </nav>
        </div>

          <!--Forum Management -->
        {{-- <div x-data="{ open: false }" class="py-2 mx-4 font-extrabold">
          <button @click="open = !open" class="rounded bg-green-600 hover:bg-green-500 w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                <i class="fa fa-comments pr-2"></i> Forum Management
              </span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </span>
          </button>
          <nav class="flex flex-col mx-3 overflow-hidden">
              <div x-show="open" x-on:click.away="open = false" >
                <a class="dropdown-menu-item text-white" href="{{ route('admin.forum.category') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  Forum Category
                </a>
              </div>
          </nav>
        </div> --}}

           <!--Content Management -->
        <div x-data="{ open: false }" class="py-2 mx-4 font-extrabold">
          <button @click="open = !open" class="rounded bg-green-600 hover:bg-green-500 w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                <i class="fa fa-comments pr-2"></i> Content Management
              </span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </span>
          </button>
          <nav class="flex flex-col mx-3 overflow-hidden">
              <div x-show="open" x-on:click.away="open = false" >
                <a class="dropdown-menu-item text-white" href="{{ route('admin.about') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  About
                </a>
              </div>
          </nav>
        </div>
          <!--User and Roles Management -->
        <div x-data="{ open: false }" class="py-2 mx-4">
          <button @click="open = !open" class="bg-green-600 hover:bg-green-500 rounded w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                <i class="fa fa-users pr-2"></i> User and Roles
              </span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </span>
          </button>
          <nav class="flex flex-col mx-3 overflow-hidden">
              <div x-show="open" x-on:click.away="open = false" >
                <a class="dropdown-menu-item" href="{{ route('admin.users.index') }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  User and Roles
                </a>
              </div>
          </nav>
        </div>

      </div>
    </div>
  </div>