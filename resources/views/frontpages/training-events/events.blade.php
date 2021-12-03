<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />

          <!-- heading-->
  <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center"> Events</h2>
    </div>
  </div>
<!-- Content -->
  <section class="pb-20 min-h-screen md:mt-10">
    <div class="container mx-auto">
    <div class="flex flex-wrap">
        <div class="w-full md:w-3/12">
          @include('frontpages.training-events._partials._sidebar')
        </div>
        <div class="w-full md:w-9/12 mt-10 md:mt-0">
            @foreach ($events as $item)
            <div class="flex flex-wrap gap-4 mb-6">
              <div class="w-full px-4 mr-auto ml-auto">
                <div class="bg-green-600 lg:flex shadow rounded-lg items-center">
                  <div class="lg:w-2/12 py-4 block h-full">
                    <div class="text-center tracking-wide">
                      <div class="text-white font-bold text-4xl ">{{ \Carbon\Carbon::parse($item->start_at)->format('d') }}</div>
                      <div class="text-white font-normal text-2xl">{{ \Carbon\Carbon::parse($item->start_at)->format('M-Y') }}</div>
                    </div>
                  </div>
                  <div class="w-full  lg:w-11/12 xl:w-full px-1 bg-white py-5 lg:px-2 lg:py-2 tracking-wide rounded-r">
                    <div class="font-bold text-gray-800 text-xl text-center lg:text-left px-2">
                      {{ $item->title }}
                    </div>
                    <div class="font-bold text-sm text-center lg:text-left p-2">
                      <span class="">From: {{ \Carbon\Carbon::parse($item->start_at)->format('d-M-Y') }}</span> <span class="ml-4"> To: {{ \Carbon\Carbon::parse($item->end_at)->format('d-M-Y') }}</span>
                    </div>
                
                    <div class="text-gray-700 font-medium text-sm pt-1 text-center lg:text-left px-2">
                      {!! $item->description !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </div>
      </div>
  </section>
</x-guest-layout>
