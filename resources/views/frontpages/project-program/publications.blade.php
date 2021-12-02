<x-guest-layout>
  <!-- Header Section-->
  <x-front.top-header />

 <!-- Content -->
<section class="pb-20 flex content-center justify-center h-screen">
  <div class="container mx-auto p-2">
    <div class="w-full md:w-full my-4 mx-auto">
        <nav class="bg-gray-100 shadow rounded py-3 w-full mt-2">
        <ol class="list-reset flex text-grey-dark text-sm pl-2">
          <li><a href="{{ route('projectprograms')}}" class="text-blue font-bold">Project Program Documents</a></li>
          <li><span class="mx-2">/</span></li>
          <li>{{ $programprojectcategory->name}}</li>
        </ol>
      </nav>
    </div>

    <div class="flex flex-wrap">
      <div class="w-full md:w-3/12">
        @include('frontpages.project-program._partials._sidebar')
      </div>

      <div class="w-full md:w-9/12">
          <form action="{{ route('search.projectprogram.document') }}" method="POST">
            @csrf
            <div class="p-6 flex flex-wrap justify-between gap-2 bg-gray-100 shadow rounded-lg">
            <div class="w-full md:w-4/12">
              <select name ="searchby" class="w-full form-control text-gray-500">
                <option value=""> Search by  </option>
                <option value="title">Project Title</option>
                <option value="agency">Implementing  Agency</option>
                <option value="funding">Funding Agency</option>
              </select>
            </div>
            <div class="w-full md: w-8/12">
              <div class="flex gap-2">
                <input type="text" name = "searchkey" placeholder="Search key" class="w-8/12 form-control"/>
                <button type ="submit" class="m-1 px-4 text-left w-1/4 rounded-md bg-green-500 text-white text-sm font-bold">
                  <i class="fa fa-search mr-2"></i> Search  
                </button>
              </div>
            </div>
          </div>
          <input type="hidden" name="category" value="{{ $programprojectcategory->id }}">
        </form>

        <div class="flex flex-wrap flex-row gap-4 mx-auto mt-10">
          <!-- Publication Documents -->
          <div class="w-full overflow-hidden">
              <h3 class="leading-6 font-bold md:text-lg pb-4 text-center uppercase">{{ $programprojectcategory->name}}</h3>
                <div class="px-4 py-2">
                  @if (!$publications->isEmpty())
                    @foreach ($publications as $item)
                    <div class="shadow rounded bg-gray-50 mb-4 p-4">
                        <div class="text-gray-800">
                            <div class="font-bold pb-2">{!! $item->title !!}</div>
                            <div class="text-md"><span class="font-semibold mr-2"> Agency:</span> {!! $item->funding !!}</div>
                            <div class="text-md"><span class="font-semibold mr-2"> Funding Amount: </span>{!! $item->amount !!}</div>
                            <div class="text-md"><span class="font-semibold mr-2"> Implementing Agency: </span>{!! $item->agency !!}</div>
                        </div>
                        <div class='flex flex-col has-tooltip gap-2'>
                            @foreach ($item->documents as $doc)
                            <a href="{{ route('projectdocument.download', $doc->id)}}" title="Download">
                              <i class="fa fa-file-download text-green-700 mr-2"></i><small class="border-b">{{ $doc->title }}</small>
                            </a>
                          @endforeach
                        </div>
                    </div>
                    @endforeach
                  @else
                    <div class="text-center col-span-3">
                      <p class="font-bold">Sorry! No results found.</p>
                      <p> Try another way</p>
                    </div>
                  @endif
              </div>
            </div>
          <div class="w-full">
            {{ $publications->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</x-guest-layout>
