<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />

    <!-- heading-->
  <div class="container mx-auto my-6">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center"> About</h2>
    </div>
  </div>

    <!-- Content -->
    <section class="p-4">
      <div class="container mx-auto">
          <div class="p-4 text-justify rounded-md shadow">
            {!! $about->content !!}
          </div>
          <div class="flex justify-center py-10">
              @if (isset($about->id))
                <img src=" {{ asset('uploads/'.$about->photo)}}" alt="about">
              @endif
          </div>
      </div>
    </section>
</x-guest-layout>
