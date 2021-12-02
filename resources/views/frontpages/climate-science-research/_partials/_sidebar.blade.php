<div class="container md:pr-4 w-full mx-2 md:mx-0">
    <div class="flex flex-col md:flex-col gap-2 justify-center">
      @foreach ($subcategories as $item)
       <div class="mb-2 shrink">
          <div class="flex max-w-sm w-full bg-gray-50 shadow rounded overflow-hidden mx-auto {{ request()->is('climate-science-research/category/'.$item->slug) ? 'bg-green-300' : 'bg-white'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full p-2">
                <a href="{{ route('climatescience.document',$item->slug)}}">
                  <h2 class="flex font-semibold text-sm gap-2 p-1"> {{ $item->name }}</h2>
                </a>
            </div>
          </div>
      </div>
      @endforeach
  </div>
</div>