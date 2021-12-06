<x-guest-layout>
     <x-front.top-header />
    <section class="container mx-auto bg-white min-h-screen">
       <div class="flex flex-wrap text-sm font-extrabold leading-8 tracking-tight justify-center py-10 uppercase gap-2 mx-2">
        <a href="{{ route('report.climate_observed') }}" class="shrink px-6 py-1 bg-gray-100 hover:bg-green-500 hover:text-white rounded shadow text-gray-700 w-full md:w-3/12 mx-2 md:mx-0">
              Observed Climate Data
        </a>
        <a href="{{ route('report.climate_projected') }}" class="shrink px-6 py-1 bg-green-600 hover:bg-green-500 rounded shadow text-gray-50 w-full md:w-3/12 mx-2 md:mx-0">
              Projected Climate Data
        </a>
          <a href="{{ route('report.climate_reanalyzed') }}" class="shrink px-6 py-1 bg-gray-100 hover:bg-green-500 hover:text-white rounded shadow text-gray-700 w-full md:w-3/12 mx-2 md:mx-0">
              Reanalyzed Climate Data
        </a>
      </div>
      <div class="flex flex-wrap">
         <div class="w-full md:w-3/12">
            @include('frontpages.analysed-data.partials._sidebar')
        </div>

        <div class="w-full md:w-9/12 px-4 mr-auto ml-auto my-6 md:my-0">
          <div class="border border-gray-300 p-6 bg-gray-50 shadow rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 p-2">
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

              <select name="model" class="form-control" id="model">
                <option>Choose Model</option>
                  @foreach($modellist as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
              </select>
              
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 p-2">
            <select name="scenerio" class="form-control" id="scenerio">
                <option>Choose Scenerio</option>
                  @foreach($sceneriolist as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
              </select>
             <!-- Start Year -->
              <div>
                  <x-jet-input id="start_year" type="text" class="form-control" name="start_yr" placeholder="{{ __('Start Year') }}"  />
                  <x-jet-input-error for="start_year" class="mt-1" />
              </div>
              
              <!-- End Year -->
              <div>
                  <x-jet-input id="end_year" type="text" class="form-control" name="end_yr" placeholder="{{ __('End Year') }}"  />
                  <x-jet-input-error for="end_year" class="mt-2" />
              </div>
            </div>
            
              @livewire('reports.climate-projected-report')
             
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
     @include('frontpages.analysed-data.climate-data.projected._drawChart')
@endpush

</x-guest-layout>