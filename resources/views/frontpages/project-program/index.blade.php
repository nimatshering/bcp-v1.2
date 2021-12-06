<x-guest-layout>
  <!-- Header Section-->
   <x-front.top-header />
   <!-- heading-->
    <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center"> Project & Program Documents </h2>
    </div>
  </div>

 <!-- Guidance Document-->
    <section class="py-6">
      <div class="container mx-auto">
        <div class="flex flex-wrap justify-between">
          <div class="w-full md:w-3/12">
            <div class="pr-4 md:pr-0">
              <div class="flex flex-col gap-2 mx-4 md:mx-0 md:pr-4">
                @foreach ($programprojectcategories as $item)
                 <div class="mb-2 shrink">
                    <div class="flex max-w-sm w-full bg-gray-50 shadow rounded overflow-hidden mx-auto">
                      <div class="w-4 bg-green-600"></div>
                      <div class="w-full p-2">
                          <a href="{{ route('projectprogram.document.category',$item->slug)}}">
                            <h2 class="flex font-semibold text-sm gap-2 p-2">{!! $item->icon !!} {{ $item->name }} </h2>
                          </a>
                      </div>
                    </div>
                </div>
                @endforeach
            </div>
          </div>
          </div>

          <div class="w-full md:w-9/12 m-4 md:m-0 p-4 shadow">
            {!! $projectprogramtext->content !!}
          </div>
        </div>
      </div>
    </section>
    
</x-guest-layout>
