<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />
                  <!-- heading-->
  <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center"> Experts</h2>
    </div>
  </div>

<!-- Content -->
  <section class="pb-20 min-h-screen md:mt-10">
    <div class="container mx-auto">
    <div class="flex flex-wrap">
        <div class="w-full md:w-3/12">
          @include('frontpages.training-events._partials._sidebar')
        </div>
        <div class="w-full md:w-9/12 mt-4 md:mt-0">
            @foreach ($experts as $item)
              <div class="md:flex shadow  mx-4 md:mx-auto bg-white rounded-lg">
                <img class="h-52 w-full md:w-1/3  object-fit rounded-lg rounded-r-none pb-5/6" src="{{ asset('uploads/'.$item->photo)}}" alt="expert">
                <div class="w-full md:w-2/3 px-4 py-4  rounded-lg">
                      <h2 class="text-xl text-gray-800 font-medium mr-auto mb-2">{{ $item->name }}</h2>
                      <h2 class=" text-gray-800 font-medium mr-auto">{{ $item->field }}</h2>
                      <h2 class=" text-gray-800 font-medium mr-auto">{{ $item->qualification }}</h2>
                    <p class="text-sm text-gray-700 mt-4">
                      {!! $item->description !!}
                    </p>
                </div>
              </div>
            @endforeach
        </div>
      </div>
  </section>
</x-guest-layout>
