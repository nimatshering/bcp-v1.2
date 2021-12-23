<x-guest-layout>
     <x-front.top-header />

  <section class="pb-20 min-h-screen">
    <div class="container mx-auto">
      <div class="flex flex-wrap text-sm font-extrabold leading-8 tracking-tight justify-center py-10 uppercase gap-2">
        <a href="{{ route('report.climate_observed') }}" class="shrink px-6 py-1 bg-gray-100 hover:bg-green-500 hover:text-white rounded shadow text-gray-700 w-full md:w-3/12 mx-4 md:mx-0">
              Observed Climate Data
        </a>
        <a href="{{ route('report.climate_projected') }}" class="shrink px-6 py-1 bg-gray-100 hover:bg-green-500 hover:text-white rounded shadow text-gray-700 w-full md:w-3/12 mx-4 md:mx-0">
              Projected Climate Data
        </a>
        <a href="{{ route('report.climate_reanalyzed') }}" class="shrink px-6 py-1 bg-gray-100 hover:bg-green-500 hover:text-white rounded shadow text-gray-700 w-full md:w-3/12 mx-4 md:mx-0">
              Reanalyzed Climate Data
        </a>
      </div>
    
      <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-3/12">
              @include('frontpages.analysed-data.partials._sidebar')
        </div>
        <div class="w-full md:8/12">
            <figure class="highcharts-figure">
                <div id="bhutanmap"></div>
            </figure>
          </div>
        </div>
        
        
    </div>
  </section>
  @push('scripts')
  @include('frontpages.analysed-data.climate-data.observed._map')
@endpush
</x-guest-layout>