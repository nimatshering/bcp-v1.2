<x-guest-layout>
     <x-front.top-header />

      <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center">Disaster DATA</h2>
    </div>
  </div>

  <section class="pb-20  min-h-screen">
    <div class="container mx-auto">
      <div class="flex flex-wrap text-sm font-extrabold leading-8 tracking-tight justify-center  uppercase gap-2 mx-4 md:mx-0">
        <a href="{{ route('report.disaster.map') }}" class="text-center shrink px-6 py-1 bg-green-600 hover:bg-green-500 rounded shadow text-gray-50 w-full md:w-3/12 ">
             Map 
        </a>
        <a href="{{ route('report.disaster.graph') }}" class="text-center shrink px-6 py-1 bg-gray-100 hover:bg-green-500 hover:text-white rounded shadow text-gray-700 w-full md:w-3/12">
            Tabular
        </a>
      </div>
    
        <div class="flex flex-wrap mt-10">
          <div class="w-full md:w-3/12">
                @include('frontpages.analysed-data.partials._sidebar')
            </div>
          <div class="w-full md:w-9/12">
            @livewire('reports.disaster-reports')
            </div>
        </div>
     </div>    
  </section>
</x-guest-layout>