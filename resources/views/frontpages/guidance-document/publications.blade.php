<x-guest-layout>
  <!-- Header Section-->
  <x-front.top-header />

 <!-- Content -->
<section class="pb-20">
  <div class="container mx-auto">
      @include('frontpages.guidance-document._partials._breadcrumbs')

   <div class="flex flex-wrap mt-10">
      <div class="w-full md:w-3/12">
        @include('frontpages.guidance-document._partials._sidebar')
    </div>
    <div class="w-full md:w-9/12">
          @include('frontpages.guidance-document._partials._searchform')

        <div class="flex flex-wrap mx-auto p-4">
          <!-- Publication Documents -->
          <div class="w-full mt-6">
              <h3 class="leading-6 font-extrabold text-lg p-2">{{ $subcategory->name}}</h3>
                <div class="p-2 border-t border-b">
                  @if (!$publications->isEmpty())
                    @foreach ($publications as $item)
                    <div class="mb-4">
                        <div class="font-medium text-gray-800 mt-4">
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
