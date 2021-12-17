<x-guest-layout>
     <x-front.top-header />

    <section class="container mx-auto min-h-screen bg-white">
       <div class="flex flex-wrap text-sm font-extrabold leading-8 tracking-tight justify-center py-10 uppercase gap-2">
        <a href="{{ route('report.climate_observed') }}" class="shrink px-6 py-1 bg-green-600 hover:bg-green-500 rounded shadow text-gray-50 w-full md:w-3/12 mx-4 md:mx-0">
              Observed Climate Data
        </a>
        <a href="{{ route('report.climate_projected') }}" class="shrink px-6 py-1 bg-gray-100 hover:bg-green-500 hover:text-white rounded shadow text-gray-700 w-full md:w-3/12 mx-4 md:mx-0">
              Projected Climate Data
        </a>
        <a href="{{ route('report.climate_reanalyzed') }}" class="shrink px-6 py-1 bg-gray-100 hover:bg-green-500 hover:text-white rounded shadow text-gray-700 w-full md:w-3/12 mx-4 md:mx-0">
              Reanalyzed Climate Data
        </a>
      </div>

      <div class="flex flex-wrap">
         <div class="w-full md:w-3/12">
            @include('frontpages.analysed-data.partials._sidebar')
        </div>

        <div class="w-full md:w-9/12 px-4">
          <div class="border border-gray-300 p-6 bg-gray-50 shadow rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-2 p-2">
              <select name ="station" id="station" class="form-control">
                <option>Choose a station</option>
                @foreach($stationlist as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>

              <select name ="parameter" id="parameter" class="form-control">
                <option>Choose Parameter</option>
                @foreach($parameterlist as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
             <!-- Start Year -->
              <div>
                <select name ="start_year" id="start_year" class="form-control">
                  <option>Start Year</option>
                  @for($year=date('Y'); $year > date('Y')-100; $year--)
                      <option value="{{ $year }}">{{ $year }}</option>
                  @endfor
                </select>
              </div>
              
              <!-- End Year -->
              <div>
                <select name ="end_year" id="end_year" class="form-control">
                  <option>End Year</option>
                    @for($year=date('Y'); $year > date('Y')-100; $year--)
                      <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
              </div>
            </div>
              @livewire('reports.climate-observed-report')
             
             <div class="my-2 text-center">
                <button  type="button" id="btnGen"  class="p-2 my-2 uppercase text-xs font-bold rounded-md bg-green-800 text-white">
                  Draw Graph
                </button>
              </div>
          </div>
          <div class="my-2 text-center">
            <p class="error"></p>
          </div>
        </div>
      </div>
      <div class="container mx-auto md:p-10 w-full md:w-11/12"> 
        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
      </div>
      
  </div>
</section>

@push('scripts')
     @include('frontpages.analysed-data.climate-data.observed._drawChart')
@endpush

</x-guest-layout>