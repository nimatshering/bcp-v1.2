<x-guest-layout>
  @push('styles')
    <style>
    .accordion-content {
    transition: max-height 0.3s ease-out, padding 0.3s ease;
    }
</style>
@endpush
  <!-- Header Section-->
  <x-front.top-header />

 <!-- Content -->
<section class="py-6">
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
            <div class="p-6 flex flex-wrap gap-2 bg-gray-100 shadow rounded-lg">
              <div class="w-full md:w-4/12">
                <select name ="searchby" class="w-full form-control text-gray-500">
                  <option value=""> Search by  </option>
                  <option value="title">Project Title</option>
                  <option value="agency">Implementing  Agency</option>
                  <option value="funding">Funding Agency</option>
                </select>
              </div>
              <div class="w-full md:w-7/12">
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
          <div class="w-full p-4">
            <h3 class="leading-6 font-bold md:text-lg pb-4 text-center uppercase">{{ $programprojectcategory->name}}</h3>
            
            @if (!$publications->isEmpty())
              @foreach ($publications as $item)
                <div class="transition shadow my-2">
                  <!-- header -->
                  <div class="bg-green-500 text-white rounded accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                      <i class="fas fa-chevron-circle-down"></i>
                      <h3 class="font-bold">{!! $item->title !!}</h3>
                  </div>
                  <!-- Content -->
                  <div class="bg-white accordion-content px-5 pt-0 overflow-hidden max-h-0">
                     <div class="border-t border-gray-200">
                        <dl>
                          <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">
                              Funding Agency
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                             {!! $item->funding !!}
                            </dd>
                          </div>
                          <div class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">
                             Fund Amount:
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                              {!! $item->amount !!}
                            </dd>
                          </div>
                          <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">
                              Implementing Agency:
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                              {!! $item->agency !!}
                            </dd>
                          </div>
                          <div class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">
                              Project Status:
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                              {!! $item->status !!}
                            </dd>
                          </div>
                           <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">
                              Project Description:
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                              {!! $item->description !!}
                            </dd>
                          </div>

                           <div class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">
                              Project Start Date:
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                              {!! $item->start_at !!}
                            </dd>
                          </div>

                          <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">
                              Project End Date:
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                              {!! $item->end_at !!}
                            </dd>
                          </div>

                        </dl>
                        <div class='flex flex-wrap items-center has-tooltip gap-2'>
                           <p class="p-4 font-bold uppercase text-xs">Project Documents</p>
                            @foreach ($item->documents as $doc)
                            <div class="p-2">
                              <a href="{{ route('projectdocument.download', $doc->id)}}" title="Download">
                              <i class="fa fa-file-pdf text-red-700 mr-2"></i><small class="border-b">{{ $doc->title }}</small>
                            </a>
                            </div>
                          @endforeach
                        </div>
                      </div>
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
          <div class="w-full">
            {{ $publications->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@push('scripts')
 <script>
    const accordionHeader = document.querySelectorAll(".accordion-header");
    accordionHeader.forEach((header) => {
    header.addEventListener("click", function () {
        const accordionContent = header.parentElement.querySelector(".accordion-content");
        let accordionMaxHeight = accordionContent.style.maxHeight;

        // Condition handling
        if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
        accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 32}px`;
        header.querySelector(".fas").classList.remove("fa-chevron-circle-down");
        header.querySelector(".fas").classList.add("fa-chevron-circle-up");
        header.parentElement.classList.add("bg-indigo-50");
        } else {
        accordionContent.style.maxHeight = `0px`;
        header.querySelector(".fas").classList.add("fa-chevron-circle-down");
        header.querySelector(".fas").classList.remove("fa-chevron-circle-up");
        header.parentElement.classList.remove("bg-indigo-50");
        }
    });
    });
</script>
@endpush
</x-guest-layout>