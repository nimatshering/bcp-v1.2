<x-guest-layout>
  <!-- Header Section-->
    <x-front.top-header />

            <!-- heading-->
  <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center"> Training Oppourtunities</h2>
    </div>
  </div>

    <!-- Content -->
    <section class="pb-20 mx-auto min-h-screen">
      <div class="container mx-auto md:mt-10">
        <div class="flex flex-wrap">
          <div class="w-full md:w-3/12">
              @include('frontpages.training-events._partials._sidebar')
            </div>
            <div class="w-full md:w-9/12">
              @foreach ($posts as $item)
                <div class="m-4 md:m-0 p-6 shadow rounded-lg  md:mb-4" data-aos="fade-up">
                    <span class="text-gray-700 font-bold hover:underline text-xl py-2">{{ $item->title }}</span>
                  <div class="mt-2 font-light text-gray-600 text-xs"> Published on: {{ $item->published_at }}</div>
                  <div class="trix-content py-2">
                    {!! $item->summary !!}
                  </div>

                  <div class="py-4">
                    <a href="{{ route('post.show', $item->slug) }}" class="bg-green-700 p-2 rounded text-white text-sm hover:bg-green-500">
                      Read More
                    </a>
                  </div>
                </div>
                @endforeach
            </div>
        </div>
      </div>
    </section>
</x-guest-layout>
