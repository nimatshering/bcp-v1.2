  <div class="flex flex-wrap">
    <div class="w-full md:w-10/12 px-4 mr-auto ml-auto">
      <div class="border border-gray-300 px-6 bg-white shadow rounded-lg">
        <form wire:submit.prevent="submit">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-4 px-2">
            <!-- Dzongkhag -->
            <div class="mt-4">
              <select wire:model.defer="ghg.sector_id" class="form-control">
                <option>Choose a Sectors</option>
                @foreach($sectors as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            
            <!-- Start Year -->
            <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-input type="text" class="form-control" wire:model.defer="ghg.start_yr" placeholder="From Year"/>
                    <x-jet-input-error for="start_year" class="mt-2" />
                </div>
            </div>
            
            <!-- End Year -->
            <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-input type="text" class="form-control" wire:model.defer="ghg.end_yr" placeholder="To Year" />
                    <x-jet-input-error for="end_year" class="mt-2" />
                </div>
            </div>
          </div>

           <div class="my-2 text-center">
            <button  type="button" id="btnGen"  class="p-2 my-2 uppercase text-xs font-bold rounded-md bg-green-800 text-white">
             Draw Graph
            </button>
          </div>
        {{-- </form> --}}
      </div>
    @if ($genReport)
      <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        @if (!$this->ghg_data->isEmpty())
        @foreach ($ghg_data as $item)
          <div class="min-w-full rounded shadow overflow-hidden my-4">
            <div class="flex">
              <!-- Disaster --> 
              <div class="w-5/12 bg-gray-50">
                <div class="overflow-hidden">
                  <div class="px-4 py-2 sm:px-6 bg-gray-300">
                  <h3 class="text-sm leading-6 uppercase font-bold text-gray-900">Sector </h3>
                  </div>
                  {{ $item->sector_id }}
                </div>
              </div>
            </div>  
          </div>
          <figure class="highcharts-figure">
            <div id="ghgchart"></div>
          </figure>
        @endforeach
        @else
          <div class="min-w-full rounded shadow overflow-hidden my-4">
          <div class="flex">
            <div class="w-full bg-gray-50 justify-center">
              <div class="overflow-hidden p-10 text-center font-bold">
                Sorry! No Data Found.
              </div>
            </div>
          </div>  
          </div>
          @endif
      </div>
    @endif
  </div>
</div>


  

  