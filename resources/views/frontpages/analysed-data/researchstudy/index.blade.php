<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />
    
     <!-- Heading -->
  <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
          <h2 class="p-3 w-full text-blue font-bold uppercase text-center">Research Study Materials</h2>
    </div>
  </div>

  <!-- Content -->
  <section class="pb-20 min-h-screen">
    <div class="container mx-auto">
        <div class="flex flex-wrap gap-4">
          <div class="w-full md:w-3/12">
              @include('frontpages.analysed-data.partials._sidebar')
          </div>
          <div class="w-full md:w-8/12">
              @foreach ($researchstudies as $item)
                <div class="md:flex shadow mx-6 md:mx-auto bg-white rounded-lg mb-4">
                  <div class="w-full md:w-2/3 p-6  rounded-lg">
                        <h2 class="text-xl text-gray-800 font-medium mr-auto mb-2">{{ $item->name }}</h2>
                      <p class="text-sm text-gray-700 mt-4">
                        {!! $item->description !!}
                      </p>
                      <h2 class="font-bold my-4 uppercase text-xs">Files & Documents</h2>
                      <div class='flex flex-col has-tooltip gap-2'>
                        @foreach ($item->documents as $doc)
                          <a href="{{ route('researchstudy.download', $doc->id)}}" title="Download">
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