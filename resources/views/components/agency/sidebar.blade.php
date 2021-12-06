<div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed z-20 inset-0 opacity-50 transition-opacity lg:hidden ">
</div>
  <!-- sidebar -->
  <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed z-30 inset-y-0 left-0 w-64 mx-60 md:w-80 transition duration-300  transform bg-green-800 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex flex-col sm:flex-row sm:justify-around">
      <div class="w-full mt-6">
        <!--Home -->
        <a href="{{ route('agency.dashboard') }}">
          <h1 class="mx-4 p-4 font-extrabold rounded uppercase text-sm bg-green-600 hover:bg-green-500 text-white py-3 mb-10">
          <i class="fa fa-home pr-2"></i> Home
        </h1>
        </a>
        <!--Climate Science & Research -->
        <div x-data="{ open: false }" class="py-2 mx-4 font-extrabold">
          <button @click="open = !open" class="rounded bg-green-600 hover:bg-green-500 w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                 Climate Science & Research
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
              @foreach (\App\Models\Csrcategory::all() as $item)
                <a class="dropdown-menu-item" href="{{ route('agency.climate.science.research', $item->id) }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  {{ $item->name }}
                </a>
              @endforeach
            </div>
          </nav>
        </div>
        
        <!--Guidance Documents -->
        <div x-data="{ open: false }" class="py-2 mx-4">
          <button @click="open = !open" class="bg-green-600 hover:bg-green-500 rounded w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                 Guidance Documents
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
                @foreach (\App\Models\Guidancedocumentcategory::all() as $item)
                <a class="dropdown-menu-item" href="{{ route('agency.guidance.document', $item->id) }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  {{ $item->name }}
                </a>
                @endforeach
              </div>
          </nav>
        </div>

         <!--Projects and Programs Documents -->
        <div x-data="{ open: false }" class="py-2 mx-4">
          <button @click="open = !open" class="bg-green-600 hover:bg-green-500 rounded w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                 Projects and Programs 
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
                @foreach (\App\Models\Programprojectcategory::all() as $item)
                <a class="dropdown-menu-item" href="{{ route('agency.programprojects.show', $item->id) }}">
                  <i class="fa fa-angle-right text-sm mr-2"></i>
                  {{ $item->name }}
                </a>
                @endforeach
              </div>
          </nav>
        </div>
       
        <!--training and events -->
        <div x-data="{ open: false }" class="py-2 mx-4">
          <button @click="open = !open" class="bg-green-600 hover:bg-green-500 rounded w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                  Training & Events
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
              <a class="dropdown-menu-item" href="{{ route('agency.posts','proposals') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                Call for Proposals
              </a>
              <a class="dropdown-menu-item" href="{{ route('agency.posts', 'trainings') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                Trainings
              </a>
                <a class="dropdown-menu-item" href="{{ route('agency.trainingmaterial.index') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                Training Materials
              </a>

              <a class="dropdown-menu-item text-white" href="{{ route('agency.events') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                Events
              </a>
              <a class="dropdown-menu-item text-white" href="{{ route('agency.experts') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                Experts
              </a>
            </div>
          </nav>
        </div>

         <!--Climate Data -->
        <div x-data="{ open: false }" class="py-2 mx-4">
          <button @click="open = !open" class="bg-green-600 hover:bg-green-500 rounded w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                  Climate Data
              </span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </span>
          </button>
          <nav class="flex flex-col mx-3 overflow-hiddenc">
            <div x-show="open" x-on:click.away="open = false" >
              <a class="dropdown-menu-item" href="{{ route('agency.climate.observed.data') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                Observed Data
              </a>
              <a class="dropdown-menu-item text-white" href="{{ route('agency.climate.projected.data') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                Projected Data
              </a>
               <a class="dropdown-menu-item text-white" href="{{ route('agency.climate.reanalyzed.data') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                Re-analyzed Data
              </a>
            </div>
          </nav> 
        </div>

         <!--Water Data -->
        <div x-data="{ open: false }" class="py-2 mx-4">
          <button @click="open = !open" class="bg-green-600 hover:bg-green-500 rounded w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                  Water Data
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
              <a class="dropdown-menu-item" href="{{ route('agency.water.observed.data') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                  Observed Data
              </a>
              <a class="dropdown-menu-item text-white" href="{{ route('agency.water.projected.data') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                  Projected Data
              </a>
            </div>
          </nav>
        </div>

         <!-- Disaster Data -->
        <div x-data="{ open: false }" class="py-2 mx-4">
          <button @click="open = !open" class="bg-green-600 hover:bg-green-500 rounded w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                  Disaster Data
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
              <a class="dropdown-menu-item" href="{{ route('agency.disaster.data') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                  Disaster
              </a>
            </div>
          </nav> 
        </div>

         <!-- Greenhouse Gas Data -->
        <div x-data="{ open: false }" class="py-2 mx-4">
          <button @click="open = !open" class="bg-green-600 hover:bg-green-500 rounded w-full flex justify-between items-center text-white p-2 focus:outline-none">
            <span class="flex items-center justify-between w-full">
              <span class="px-2 text-xs font-bold uppercase">
                  Greenhouse Gas Data
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
              <a class="dropdown-menu-item" href="{{ route('agency.ghg.data') }}">
                <i class="fa fa-angle-right text-sm mr-2"></i>
                GHG Data
              </a>
            </div>
          </nav>  
        </div>

         <!-- Research Study Documents -->
        <a href="{{ route('agency.researchstudy.index') }}">
          <h1 class="mx-4 p-4 font-extrabold rounded uppercase text-xs bg-green-600 hover:bg-green-500 text-white py-3 mb-2">
             Assesement Datasets
          </h1>
        </a>

         <!-- FAQs -->
        <a href="{{ route('agency.faqs') }}">
          <h1 class="mx-4 p-4 font-extrabold rounded uppercase text-xs bg-green-600 hover:bg-green-500 text-white py-3 mb-2">
             Faqs
          </h1>
        </a>

          {{-- <!-- Discussion Forum -->
        <a href="{{ route('agency.forum.index') }}">
          <h1 class="mx-4 p-4 font-extrabold rounded uppercase text-sm bg-green-600 hover:bg-green-500 text-white py-3 mb-10">
             Discussion Forum
        </h1>
        </a> --}}
      </div>
    </div>
  </div>