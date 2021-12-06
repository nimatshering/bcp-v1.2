<x-guest-layout>
  <!-- Header Section-->
   <x-front.top-header />

   <!-- breadcrumbs-->
   <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
      <h2 class="p-3 w-full text-blue font-bold uppercase text-center">Climate Science and Research</h2>
    </div>
  </div>

 <!-- Guidance Document-->
    <section class="relative py-6 flex content-center justify-center bg-white min-h-screen">
      <div class="container mx-auto px-4 md:px-0">
        <div class="flex flex-wrap">
          <div class="md:w-3/12 w-full">
            @foreach ($categories as $item)
              <div class="mb-2 shrink md:pr-4">
                <div class="flex max-w-sm w-full bg-gray-50 shadow rounded overflow-hidden mx-auto">
                  <div class="w-4 bg-green-600"></div>
                  <div class="w-full">
                      <a href="{{ route('climatescience.subcategory',$item->slug)}}">
                        <h2 class="flex text-md p-4"><span class="pr-2">{!! $item->icon !!}</span> {{ $item->name }} </h2>
                      </a>
                  </div>
                </div>
            </div>
              @endforeach
          </div>

          <div class="w-full md:w-9/12 p-4 shadow mt-4 md:mt-0">
            {!! $climatescience->content !!}
          </div>
        </div>
      </div>
    </section>
</x-guest-layout>
