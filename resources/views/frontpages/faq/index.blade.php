<x-guest-layout>
  <!-- Header Section-->
<x-front.top-header />

 <!-- component -->
      <section class="text-gray-700 min-h-screen">
        <div class="container px-5 py-10 mx-auto w-8/12">
          <div class="text-center mb-10">
            <h1 class="sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">
              Frequently Asked Question
            </h1>
            <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">
              The most common questions about how our business works and what
              can do for you.
            </p>
          </div>
           <div class="w-full px-4">
                @foreach ($faqs as $item)
                  <details class="mb-4">
                    <summary class="px-4 py-2 font-semibold bg-gray-200 rounded-md my-2">
                      {{ $item->question }}
                    </summary>
                    <span class="trix-content py-2 mx-4">
                      {!! $item->answer !!}
                    </span>
                  </details>
                 @endforeach
              </div>
        </div>
      </section>
</x-guest-layout>
