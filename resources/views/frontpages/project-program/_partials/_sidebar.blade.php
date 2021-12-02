<div class="container md:pr-4 w-full mx-auto">
    <div class="flex flex-col gap-2 justify-center">
      @foreach ($programprojectcategories as $item)
      <div class="mb-2 shrink">
          <div class="flex max-w-sm w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('projectprogram/'.$item->slug) ? 'bg-green-300' : 'bg-white'}}">
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