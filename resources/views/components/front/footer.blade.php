 <footer class="bg-deepblue-900 md:pt-20">
    <div class="max-w-6xl m-auto text-gray-800 flex flex-wrap justify-left">
      <!-- Col-1 -->
      <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
        <!-- Col Title -->
        @php $link1 = App\Models\Linkcategory::where('id',1)->first() @endphp
        <div class="text-xs uppercase text-gray-400 font-medium mb-6">
          {{ $link1->name }}
        </div>
        <!-- Links -->
        @foreach ($link1->links as $item)
          <a href="{{ $item->linkurl }}" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
            {{ $item->name }}
          </a>
        @endforeach
      </div>

      <!-- Col-2 -->
      @php $link2 = App\Models\Linkcategory::where('id',2)->first() @endphp
      <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
        <!-- Col Title -->
        <div class="text-xs uppercase text-gray-400 font-medium mb-6">
          {{ $link2->name }}
        </div>

        <!-- Links -->
         @foreach ($link2->links as $item)
          <a href="{{ $item->linkurl }}" class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
            {{ $item->name }}
          </a>
        @endforeach
      </div>

      <!-- Col-3 -->
      <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
        @php $link3 = App\Models\Linkcategory::where('id',3)->first() @endphp
        <div class="text-xs uppercase text-gray-400 font-medium mb-6">
           {{ $link3->name }}
        </div>
      </div>

      <!-- Col-3 -->
      <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
        @php $link4 = App\Models\Linkcategory::where('id',4)->first() @endphp
        <div class="text-xs uppercase text-gray-400 font-medium mb-6">
           {{ $link4->name }}
        </div>
      </div>
    </div>

    <!-- Copyright Bar -->
    <div class="pt-2">
      <div class="flex pb-5 px-3 m-auto pt-5 
                          border-t border-gray-500 text-gray-400 text-sm 
                          flex-col md:flex-row max-w-6xl justify-center">
        <div class="mt-2">
          © Copyright 2021 NECS. All Rights Reserved. | 
        </div>
          <div class="mt-2">
            <a href="{{ route('login') }}"
                class="text-gray-400 hover:text-gray-300 font-bold px-6">Login
            </a>
        </div>
      </div>
    </div>
  </footer>