<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />

     <!-- breadcrumbs-->
  <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center">DATA</h2>
    </div>
  </div>

  <!-- Climate Science -->
    <section class="pb-20 min-h-screen">
      <div class="container mx-auto">
      <div class="flex flex-wrap">
        <div class="w-full md:w-3/12">
          <div class="md:pr-4">
            @include('frontpages.analysed-data.partials._sidebar')
          </div>
        </div>
        <div class="w-full md:w-9/12">
          <div class="flex flex-wrap">
            <div class="w-full p-4 mx-4 md:mx-0 shadow">
              {!! $datatext->content !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-guest-layout>