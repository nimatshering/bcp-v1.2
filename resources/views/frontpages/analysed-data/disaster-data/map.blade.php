<x-guest-layout>
     <x-front.top-header />

  <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center">Disaster DATA</h2>
    </div>
  </div>

  <section class="pb-20 min-h-screen">
    <div class="container mx-auto">
        <div class="flex flex-wrap text-sm font-extrabold leading-8 tracking-tight justify-center py-2 uppercase gap-2 mx-2 md:mx-0">
          <a href="{{ route('report.disaster.map') }}" class="text-center shrink px-6 py-1 bg-green-600 hover:bg-green-500 rounded shadow text-gray-50 w-full md:w-3/12 mx-2 md:mx-0">
              Map 
          </a>
          <a href="{{ route('report.disaster.graph') }}" class="text-center shrink px-6 py-1 bg-gray-100 hover:bg-green-500 hover:text-white rounded shadow text-gray-700 w-full md:w-3/12 mx-2 md:mx-0">
              Tabular
          </a>
        </div>
    
        <div class="flex flex-wrap mt-10">
          <div class="w-full md:w-3/12">
                @include('frontpages.analysed-data.partials._sidebar')
            </div>
          <div class="w-full md:w-8/12">
            <div class="p-4 bg-gray-50 mx-2 mb-4 rounded shadow ">
              <form action="{{ route('generate.map.data')}}" method="POST">
                 @csrf
                <div class="flex flex-wrap gap-2 items-center">
                  <div class="form-group w-full md:w-4/12">
                    <select name ="disasterId" class="form-control">
                      <option>Choose Disaster Type</option>
                      @foreach($disasterType as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="w-full md:w-4/12">
                     <!-- Start Year -->
                        <select name ="year" id="year" class="form-control">
                          <option>Start Year</option>
                          @for($year=date('Y'); $year > date('Y')-100; $year--)
                              <option value="{{ $year }}">{{ $year }}</option>
                          @endfor
                        </select>
                  </div>

                  <div class="w-full md:w-3/12">
                    <button type="submit" class="bg-blue-500 px-4 py-2 rounded text-white hover:bg-blue-600 text-sm uppercase">Submit</button>
                  </div>
                </div>
              </form>
            </div>

            <div class="container m-2">
              <figure class="highcharts-figure">
              <div id="bhutanmap"></div>
            </figure>
            </div>
          </div>
        </div>
     </div>    
  </section>
  @push('scripts')
  @include('frontpages.analysed-data.disaster-data._map')
@endpush
</x-guest-layout>