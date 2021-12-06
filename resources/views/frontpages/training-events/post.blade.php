<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />

     <!-- heading-->
  <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center"> Events & Trainings</h2>
    </div>
  </div>

 <!-- Content -->
    <section class="my-4 min-h-screen">
      <div class="container mx-auto md:mt-10">
        <div class="flex flex-wrap">
           <div class="w-full md:w-3/12">
            @include('frontpages.training-events._partials._sidebar')
          </div>
          
          <div class="w-full md:w-9/12 p-4 m-4 md:m-0 shadow">
            {!! $trainingevents->content !!}
          </div>
        </div>
      </div>
    </section>
</x-guest-layout>
