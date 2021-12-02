<x-guest-layout>
  <!-- Header Section-->
  <x-front.top-header />

 <!-- Content -->
<section class="pb-10">
  <div class="container mx-auto">
      @include('frontpages.climate-science-research._partials._breadcrumbs')

    <div class="flex flex-wrap w-full justify-between mt-4">
        <div class="m-2 md:m-0 w-full md:w-3/12">
          @include('frontpages.climate-science-research._partials._sidebar')
        </div>
        <div class="m-2 md:m-0 w-full md:w-9/12">
              @include('frontpages.climate-science-research._partials._searchform')
            <div class="flex flex-wrap flex-row gap-4 mx-auto mt-10">
              <!-- Climate Science Research Documents -->
              <div class="w-full overflow-hidden">
                  <h3 class="leading-6 font-bold md:text-xl p-4">{{ $subcategory->name }}</h3>
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
                                  <span class='tooltip rounded bg-green-500 text-white py-1 px-2 mt-8  text-xs text-bold'>Download</span>
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
                </div>
              <div class="w-full">
                {{-- {{ $publications->links() }} --}}
              </div>
            </div>
        </div>
    </div>
  </div>
</section>
</x-guest-layout>
