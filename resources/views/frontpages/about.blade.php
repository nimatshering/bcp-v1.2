<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />
    <!-- Content -->
    <section class="container mx-auto flex md:flex-row w-full gap-4 min-h-screen">
      <div class="w-full md:w-8/12  px-6 py-4 mx-auto bg-gray-50 rounded-md shadow my-4">
        <h2 class="text-3xl text-center text-gray-800 uppercase font-bold">About</h2>
       
          <div class="py-10">
            {!! $about->content !!}
          </div>
          <div class="py-10">
              @if (isset($about->id))
                <img src=" {{ asset('uploads/'.$about->photo)}}" alt="about">
              @endif
          </div>
      </div>
    </section>
</x-guest-layout>
