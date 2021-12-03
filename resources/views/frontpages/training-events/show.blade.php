<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />

    <!-- Content -->
    
  <section class="pb-20 bg-gray-100 py-6">
    <div class="flex container mx-auto">
     <div class="w-3/12">
            @include('frontpages.training-events._partials._sidebar')
        </div>
    <div class="px-4 w-full md:w-8/12">
      <div class="p-10 rounded-lg shadow">
        <div class="flex justify-between items-center">
          <span class="font-light text-gray-600"> {!! $post->published_at !!}</span>
        </div>
        <div class="mt-2 text-lg text-gray-700 font-bold hover:underline py-2">
          {!! $post->title !!}
        </div>
        <div class="trix-content">
        {!! $post->description !!}
        </div>
      </div>
    </div>
  </div>
  </section>
</x-guest-layout>
