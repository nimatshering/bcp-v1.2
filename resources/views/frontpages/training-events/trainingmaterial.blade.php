<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />

               <!-- heading-->
  <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center"> Training Materials</h2>
    </div>
  </div>

<!-- Content -->
  <section class="pb-20 min-h-screen md:mt-10">
    <div class="container mx-auto">
    <div class="flex flex-wrap ">
        <div class="w-full md:w-3/12">
          @include('frontpages.training-events._partials._sidebar')
        </div>
        <div class="w-full md:w-9/12 mt-4 md:mt-0">
            @foreach ($trainingmaterials as $item)
              <div class="md:flex shadow mx-4 md:mx-6 bg-white rounded-lg mb-4">
                <div class="w-full md:w-2/3 p-6  rounded-lg">
                      <h2 class="text-gray-800 font-bold mr-auto mb-2">{{ $item->name }}</h2>
                    <p class="text-sm text-gray-700 mt-4">
                      {!! $item->description !!}
                    </p>
                    <h2 class="font-semibold my-4">Documents</h2>
                    <div class='flex flex-col has-tooltip gap-2'>
                      @foreach ($item->documents as $doc)
                      <a href="{{ route('trainingmaterial.download', $doc->id)}}" title="Download">
                        <i class="fa fa-file-download text-green-700 mr-2"></i><small class="border-b">{{ $doc->title }}</small>
                      </a>
                    @endforeach
                  </div>
                </div>
              </div>
            @endforeach
        </div>
      </div>
  </section>
</x-guest-layout>
