    <!-- water observed data -->
    <div class="flex flex-col md:gap-2 mx-4 md:mx-0">
      <div class="mb-2 shrink">
          <div class="flex max-w-sm w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('data/water-observed-report') ? 'bg-green-300' : 'bg-white'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full p-2">
                <a href="{{ route('report.water_observed.map') }}">
                  <h2 class="flex font-semibold text-sm gap-2 p-2"> Water </h2>
                </a>
            </div>
          </div>
      </div>
  </div>

  <!-- climate observed data -->
  <div class="flex flex-col md:gap-2 mx-4 md:mx-0">
      <div class="mb-2 shrink">
          <div class="flex max-w-sm w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('data/climate-observed-report') ? 'bg-green-300' : 'bg-white'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full p-2">
                <a href="{{ route('report.climate_observed.map') }}">
                  <h2 class="flex font-semibold text-sm gap-2 p-2"> Climate </h2>
                </a>
            </div>
          </div>
      </div>
  </div>

   <!-- disaster data -->
  <div class="flex flex-col md:gap-2 mx-4 md:mx-0">
      <div class="mb-2 shrink">
          <div class="flex max-w-sm w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('data/disaster-report') ? 'bg-green-300' : 'bg-white'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full p-2">
                <a href="{{ route('report.disaster.map') }}">
                  <h2 class="flex font-semibold text-sm gap-2 p-2"> Disaster </h2>
                </a>
            </div>
          </div>
      </div>
  </div>

  <!-- ghg data -->
  <div class="flex flex-col md:gap-2 mx-4 md:mx-0">
      <div class="mb-2 shrink">
          <div class="flex max-w-sm w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('data/ghg-report') ? 'bg-green-300' : 'bg-white'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full p-2">
                <a href="{{ route('report.ghg') }}">
                  <h2 class="flex font-semibold text-sm gap-2 p-2"> Greenhouse Gases </h2>
                </a>
            </div>
          </div>
      </div>
  </div>

  <!-- Research Study Documents -->
  <div class="flex flex-col md:gap-2 mx-4 md:mx-0">
      <div class="mb-2 shrink">
          <div class="flex max-w-sm w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('researchstudies') ? 'bg-green-300' : 'bg-white'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full p-2">
                <a href="{{ route('researchstudies') }}">
                  <h2 class="flex font-semibold text-sm gap-2 p-2"> Research Study Documents (Datasets) </h2>
                </a>
            </div>
          </div>
      </div>
  </div>
