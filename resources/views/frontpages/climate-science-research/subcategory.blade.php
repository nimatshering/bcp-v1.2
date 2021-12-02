<x-guest-layout>
  <!-- Header Section-->
   <x-front.top-header />

 <!-- Guidance Document-->
    <section class="pb-10">
     <div class="container mx-auto">
           @include('frontpages.climate-science-research._partials._breadcrumbs')

        <div class="flex flex-wrap mt-4">
            <div class="mb-2 w-full md:w-3/12">
              <div class="flex flex-col gap-2 justify-center mx-2 md:mx-0 md:pr-4">
                @foreach ($subcategories as $item)
                <div class="mb-2 shrink">
                  @if ($loop->first)
                        @php $bgcolor ='bg-green-300' @endphp
                      @else
                        @php $bgcolor ='bg-gray-50' @endphp  
                    @endif

                  <div class="flex max-w-sm  bg-gray-50 shadow rounded overflow-hidden mx-auto {{$bgcolor}}">
                    <div class="w-4 bg-green-600"></div>
                    <div class="w-full p-2">
                        <a href="{{ route('climatescience.document',$item->slug)}}">
                          <h2 class="flex font-semibold text-sm gap-2 p-1">{{ $item->name }}</h2>
                        </a>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>

            <div class="m-2 md:m-0 w-full md:w-9/12">
              @include('frontpages.climate-science-research._partials._searchform')
              <div class="flex flex-wrap flex-row gap-4 mx-auto mt-10">
                <!-- Publication Documents -->
                  <h3 class="leading-6 font-bold md:text-xl p-4">{{ $subcategory->name}}</h3>
                      <div class="px-4 py-2 border-t border-b">
                        @if (!$publications->isEmpty())
                          @foreach ($publications as $item)
                              <div class="text-sm font-medium text-gray-800">
                                <div class="font-semibold text-xl">{!! $item->title !!}</div>
                                  <div class="text-md font-semibold">Author: {!! $item->author !!}</div>
                              </div>
                            @if ($item->document)
                              <div class="mt-1">
                                <div class='has-tooltip'>
                                  <a href="{{ route('climatescience.download', $item->slug)}}" class="text-red-600 hover:text-red-500 text-2xl">
                                      <i class="fa fa-file-pdf"></i>
                                    </a>
                                    <span class='tooltip rounded bg-geen-500 py-1 px-2 mt-8 text-white text-xs text-bold'>Download</span>
                                  </div>
                              </div>
                            @endif
                          @endforeach
                        @else
                          <div class="text-center col-span-3">
                            <p class="font-bold">Sorry! No results found.</p>
                            <p> Try another way</p>
                          </div>
                        @endif
                    </div>
                <div class="w-full">
                  {{-- {{ $documents->links() }} --}}
                </div>
              </div>
            </div>
        </div>
       </div>
      
        
    </section>
</x-guest-layout>
