<x-guest-layout>
  <!-- Header Section-->
   <x-front.top-header />
 
   <!-- Heading-->
   <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center"> Guidance Documents</h2>
    </div>
  </div>

 <!-- Guidance Document-->
    <section class="pb-10">
      <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
          <div class="w-full md:w-3/12">
            @foreach ($guidancecategories as $item)
              <div class="mb-2 shrink md:pr-4">
                <div class="flex max-w-sm w-full bg-gray-50 shadow rounded overflow-hidden mx-auto">
                  <div class="w-4 bg-green-600"></div>
                  <div class="w-full p-2">
                      <a href="{{ route('guidance.subcategory',$item->slug)}}">
                        <h2 class="flex font-extrabold text-md gap-2 p-2">{!! $item->icon !!} {{ $item->name }} </h2>
                      </a>
                  </div>
                </div>
            </div>
              @endforeach
          </div>

          <div class="w-full md:w-9/12 p-4 mr-auto ml-auto shadow">
           {!! $guidancedocument->content !!} 
          </div>
        </div>
      </div>
    </section>
</x-guest-layout>
