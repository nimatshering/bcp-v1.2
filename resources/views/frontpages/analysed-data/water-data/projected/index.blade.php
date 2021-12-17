<x-guest-layout>
   <x-front.top-header />

<section class="pb-20 min-h-screen">
    <div class="container mx-auto">
      <div class="flex flex-wrap font-bold text-sm leading-8 tracking-tight justify-center py-10 uppercase gap-2">
        <a href="{{ route('report.water_observed') }}" class="shrink px-6 py-1 bg-gray-300 hover:bg-green-500 rounded shadow text-gray-700 w-full md:w-4/12 mx-2 md:mx-0">
              Observed Water Data
        </a>
        <a href="{{ route('report.water_projected') }}" class="shrink px-6 py-1 bg-green-600 hover:bg-green-500  hover:text-white rounded shadow text-gray-50 w-full md:w-4/12 mx-2 md:mx-0">
              Projected Water Data
        </a>
      </div>
      <div class="flex flex-wrap">
        <div class="w-full md:w-3/12">
            @include('frontpages.analysed-data.partials._sidebar')
        </div>

        <div class="w-full md:w-9/12 px-4 mr-auto ml-auto">
          <div class="border border-gray-300 p-6 bg-gray-50 shadow rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 p-2">
              <select id="station"  class="form-control">
                <option>Choose a station</option>
                @foreach($stationlist as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>

              <select id="parameter" name="parameter" class="form-control">
                <option>Choose Parameter</option>
                @foreach($parameterlist as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
  
              <select id="model" name="model" class="form-control">
                <option>Choose Model</option>
                @foreach($modellist as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-1 p-2">     
              <select id="scenerio" name="scenerio" class="form-control">
                <option>Choose Scenerio</option>
                @foreach($sceneriolist as $item)
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
          
             @livewire('reports.water-projected-report')
            
            <div class="flex justify-center">
             <button type="button" id="btnGen" class="font-bold py-2 px-4 m-3 bg-green-400 text-xs uppercase rounded-full shadow text-white focus:outline-none hover:bg-green-500 ">
                Draw Chart
              </button>
            </div>
          </div>
          <div class="my-2 text-center">
            <p class="error"></p>
          </div>
        </div>
        </div>
      </div>

      <div class="container mx-auto md:p-10 w-full md:w-11/12"> 
        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
        </div>
</div>
@push('scripts')
     @include('frontpages.analysed-data.water-data.projected._drawChart')
@endpush
</x-guest-layout>