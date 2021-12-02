<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />
<!-- Content -->
  <section class="pb-20 bg-gray-100 min-h-screen">
    <div class="container mx-auto">
    <h2 class="flex md:text-2xl font-extrabold leading-8 tracking-tight justify-center py-2 md:py-6 uppercase">Videos</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
             @foreach ($mediagallery as $item)
              <div class="w-full p-4 md:p-0">
                <div class="video-container">
                  <iframe class="video" src="{{ $item->videolink }}" allowfullscreen></iframe>
                </div>
              </div>
               @endforeach
        </div>
  </section>
</x-guest-layout>
