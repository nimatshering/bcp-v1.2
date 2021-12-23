<x-guest-layout>
     <x-front.top-header />

  <section class="pb-20 min-h-screen">
    <div class="container mx-auto">
      <div class="flex flex-wrap text-sm font-bold leading-8 tracking-tight justify-center py-10 uppercase gap-2">
        <a href="{{ route('report.water_observed') }}" class="shrink px-6 py-1 bg-gray-300 hover:bg-green-500  hover:text-white rounded shadow text-gray-700 w-full md:w-4/12 mx-2 md:mx-0">
              Observed Water Data
        </a>
        <a href="{{ route('report.water_projected') }}" class="shrink px-6 py-1 bg-gray-300 hover:bg-green-500  hover:text-white rounded shadow text-gray-700 w-full md:w-4/12 mx-2 md:mx-0">
              Projected Water Data
        </a>
      </div>
    
        <div class="flex flex-wrap">
          <div class="w-full md:w-3/12">
                @include('frontpages.analysed-data.partials._sidebar')
          </div>
          <div class="w-full md:w-8/12">
              <figure class="highcharts-figure">
                  <div id="bhutanmap"></div>
              </figure>
          </div>
        </div>
     </div>    
  </section>
  @push('scripts')
  @include('frontpages.analysed-data.water-data.observed._map')
@endpush
</x-guest-layout>