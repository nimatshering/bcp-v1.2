  <div class="flex flex-wrap">
    <div class="w-full px-4 mr-auto ml-auto">
      <div class="border border-gray-300 px-6 bg-white shadow rounded-lg">
        <form wire:submit.prevent="submit">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-2 py-4 px-2">
            <!-- Dzongkhag -->
            <div class="mt-4">
              <select wire:model.defer="disaster.dzongkhag_id" class="form-control">
                <option>Choose a Dzongkhag</option>
                @foreach($dzongkhags as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <!-- Disaster Type -->
            <div class="mt-4">
              <select wire:model.defer="disaster.type_id" class="form-control">
                <option>Choose Hazard Type</option>
                @foreach($disastertypes as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>

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
              <button type="submit"  class="p-2 my-2 uppercase text-xs font-bold rounded-md bg-green-800 text-white">
                Generate
              </button>
            </div>
        </form>
      </div>

      @if ($genReport)
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
          @if (!$this->disasters->isEmpty())
            @foreach ($this->disasters as $disaster)
              <div class="min-w-full rounded shadow overflow-hidden my-4">
              <div class="flex">
                <!-- Disaster --> 
                <div class="w-5/12 bg-gray-50">
                  <div class="overflow-hidden">
                    <div class="px-4 py-2 sm:px-6 bg-gray-300">
                      <h3 class="text-sm leading-6 uppercase font-bold text-gray-900">
                        {!! optional(App\Models\Dzongkhag::find($disaster->dzongkhag_id))->name; !!}
                      </h3>
                    </div>
                    <dl>
                      <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                          Disaster Type
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                          {!! optional(App\Models\Disastertype::find($disaster->type_id))->name; !!}
                        </dd>
                      </div>
                      <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                          Disaster Date
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                          {{ Carbon\Carbon::parse($disaster->disaster_date)->format('j F Y')}}
                        </dd>
                      </div>
                      <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                          Data Source
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                          {{ $disaster->data_source }}
                        </dd>
                      </div>
                      
                      <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                          Remarks
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $disaster->remarks }}
                        </dd>
                      </div>
                      <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                          Disaster Report
                        </dt>
                        @if (!is_null($item->report_link))
                          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <a href="{{ route('disaster.report.download', $disaster->report_link)}}" class="px-4 py-1 font-medium bg-gray-700 hover:bg-gray-500 rounded text-white">
                              Download
                            </a>
                        </dd>
                        @else
                          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            Report not avaliable
                          </dd>
                        @endif
                      </div>
                    </dl>
                  </div>
                </div>
                <!-- impact -->
                <div class="w-7/12 bg-gray-0">
                  <div class="overflow-hidden sm:rounded-r border-l">
                    <div class="px-4 py-2 sm:px-1 bg-gray-200">
                      <h3 class="text-lg leading-6 font-bold text-gray-900">
                      Disaster Impact
                      </h3>
                    </div>
                    @foreach ($disaster->impacts as $item)
                      <dl class="border-b border-gray-200">
                          <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              {!! optional(App\Models\DisasterParameter::find($item->parameter_id))->name !!}
                            </dd>
                          </div>

                          <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              {!! $item->value !!}
                            </dd>
                          </div>

                          <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              {!! $item->description !!}
                            </dd>
                          </div>
                      </dl>
                      @endforeach
                  </div>
                </div>
              </div>  
              </div>
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
        </div>
      @endif
    </div>
  </div>
 
  
  

