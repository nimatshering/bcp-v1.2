<x-guest-layout>
     <x-front.top-header />

  <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center">Greenhouse Gases - Data</h2>
    </div>
  </div>

  <section class="pb-20 bg-white min-h-screen">
    <div class="container mx-auto">
      <div class="flex flex-wrap">
         <div class="w-full md:w-3/12">
            @include('frontpages.analysed-data.partials._sidebar')
        </div>

        <div class="w-full md:w-9/12 px-4 mr-auto ml-auto">
          <div class="border border-gray-300 p-6 bg-gray-50 shadow rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2">
            <!-- Start Year -->
              <div class="mt-4">
                <select name ="start_year" id="start_year" class="form-control">
                  <option>Start Year</option>
                  @for($year=date('Y'); $year > date('Y')-100; $year--)
                      <option value="{{ $year }}">{{ $year }}</option>
                  @endfor
                </select>
              </div>
              
              <!-- End Year -->
              <div class="mt-4">
                <select name ="end_year" id="end_year" class="form-control">
                  <option>End Year</option>
                    @for($year=date('Y'); $year > date('Y')-100; $year--)
                      <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
              </div>
            </div>
             
             <div class="my-2 text-center">
                <button  type="button" id="btnGen"  class="p-2 my-2 uppercase text-xs font-bold rounded-md bg-green-800 text-white">
                  Draw Graph
                </button>
              </div>
          </div>
        </div>
      </div>

      <div class="container mx-auto w-full p-2 md:w-11/12"> 
        <figure class="highcharts-figure">
            <div id="ghgchart"></div>
        </figure>
      </div>
</div>
</section>

@push('scripts')
     @include('frontpages.analysed-data.ghg-data._drawChart')
@endpush

</x-guest-layout>