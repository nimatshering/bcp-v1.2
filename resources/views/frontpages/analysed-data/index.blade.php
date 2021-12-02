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
            @include('frontpages.analysed-data.partials._sidebar')
        </div>
        <div class="w-full md:w-9/12">
          <div class="flex flex-wrap">
            <div class="w-full px-4 mr-auto ml-auto" data-aos="fade-up">
              <p class="text-justify py-2">
                Bhutan can also be characterized into six agro-climatic regions: alpine, cool temperate, warm temperate, dry 
                sub-tropical, humid sub-tropical, and wet-sub tropical. Climate varies dramatically because of the countries 
                varied topography and geographical location at the edge of the tropical circulation in then north and Asian 
                monsoon circulation in the south. The northern part of the country is characterized by snowcapped peaks of 
                elevations above 7,300 meters with abundant glaciers and alpine pastures. Regions at lower elevations and closer 
                to the south tend to have higher temperatures as well as more precipitation while the northern regions of the 
                country are often cooler and experiences less precipitation.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-guest-layout>
