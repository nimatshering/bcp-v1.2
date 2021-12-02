<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />
<!-- Content -->
  <section class="pb-20 bg-gray-100 min-h-screen">
    <div class="container mx-auto">
    <h2 class="flex md:text-2xl font-extrabold leading-8 tracking-tight justify-center py-6">Media Gallery</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 justify-between">
             @foreach ($mediagallery as $item)
              <div class="w-full">
                <div class="video-container" data-aos="zoom-in">
                  <iframe class="video" src="{{ $item->videolink }}" allowfullscreen></iframe>
                </div>
              </div>
               @endforeach
        </div>
  </section>
</x-guest-layout>
