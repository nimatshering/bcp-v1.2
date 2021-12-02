<x-app-layout>
    <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-10 font-extrabold uppercase">
            Bhutan Climate Portal
      </div>

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-100 overflow-hidden shadow sm:rounded-lg">
          <div class="p-4 bg-white border-b border-gray-200">
              <p class="uppercase py-2 font-bold">
               Agency Dashboard
              </p>
          </div>

          <div class="bg-white bg-opacity-25 grid grid-cols-1 md:grid-cols-3">
            {{-- @foreach ($thematics as $item) --}}
              <div class="p-6">
                  {{-- <a href="{{ route($item->link) }}"> --}}
                <div
                  class="select-none cursor-pointer bg-white shadow rounded flex flex-1 items-center p-2 hover:shadow-lg">
                  <div class="p-3">
                    {{-- <div class="uppercase text-sm font-semibold">{{ $item->name }}</div> --}}
                  </div>
                </div>
              </a>
              </div>
            {{-- @endforeach --}}
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
