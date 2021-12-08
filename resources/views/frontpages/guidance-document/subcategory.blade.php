<x-guest-layout>
  <!-- Header Section-->
   <x-front.top-header />

 <!-- Guidance Document-->
    <section class="pb-20">
     <div class="container mx-auto">
           @include('frontpages.guidance-document._partials._breadcrumbs')

        <div class="flex flex-wrap mt-10">
          <div class="w-full md:w-3/12 m-4 md:m-0">
              <div class="flex flex-col gap-4 justify-center md:pr-4 mx-4 md:mx-0">
                @foreach ($subcategories as $item)
                  <div class="mb-2 shrink">
                  @if ($loop->first)
                        @php $bgcolor ='bg-green-300' @endphp
                      @else
                        @php $bgcolor ='bg-gray-50' @endphp  
                    @endif
                    <div class="flex max-w-sm  bg-white shadow rounded overflow-hidden mx-auto {{$bgcolor}}">
                      <div class="w-4 bg-green-600"></div>
                      <div class="w-full p-2">
                          <a href="{{ route('guidance.document',$item->slug)}}">
                            <h2 class="flex font-semibold text-sm gap-2 p-1">{!! $item->icon !!} {{ $item->name }} </h2>
                          </a>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
          </div>
      
          <div class="w-full md:w-9/12 mx-4 md:mx-0">
                @include('frontpages.guidance-document._partials._searchform')
            <div class="flex flex-wrap mx-auto p-4">
          <!-- Publication Documents -->
          <div class="mt-6">
              <h3 class="leading-6 font-extrabold text-lg p-2">{{ $subcategory->name}}</h3>
                <div class="p-2 border-t border-b">
                  @if (!$publications->isEmpty())
                    @foreach ($publications as $item)
                    <div class="mb-4">
                        <div class="font-medium text-gray-800">
                            <div class="font-bold">{!! $item->title !!}</div>
                            <div class="text-sm">Author: {!! $item->author !!}</div>
                        </div>
                        @if ($item->document)
                          <div class="mt-1">
                          <div class='has-tooltip'>
                            <a href="{{ route('guidance.download', $item->slug)}}" class="text-red-600 hover:text-red-500 text-2xl">
                                <i class="fa fa-file-pdf"></i>
                              </a>
                              <span class='tooltip rounded bg-green-500 text-white py-1 px-2 mt-8  text-xs text-bold'>Download</span>
                            </div>
                          </div>
                        @endif
                    </div>
                    @endforeach
                  @else
                    <div class="text-center col-span-3">
                      <p class="font-bold">Sorry! No results found.</p>
                      <p> Try another way</p>
                    </div>
                  @endif
              </div>
            </div>
          <div class="w-full">
            {{ $publications->links() }}
          </div>
        </div>
          </div>
        </div>
      </div>
    </section>
</x-guest-layout>
