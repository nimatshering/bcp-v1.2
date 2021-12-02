<div>
    <h2 class="pt-4 font-bold"> Documents Upload</h2>
  <div class="mb-10">
   <div class="py-2 w-8/12">
      <div class="mt-2">
        <div class="w-full">
            <x-jet-input id="title" type="text" placeholder="Document Title" class="form-control mt-1 block w-full" wire:model.defer="trainingmaterial.title" />
            <x-jet-input-error for="trainingmaterial.title"/>
        </div>

        <div class="mt-2 w-full">
            <x-jet-input id="document" type="file" class="form-control mt-1 block w-full" wire:model.defer="document" />
            <x-jet-input-error for="document"/>
        </div>
      </div> 
        <button class="my-4 bg-green-700 hover:bg-green-600 text-white px-2 py-1 text-xs rounded" wire:click.prevent="store" wire:loading.attr="disabled">
            <i class="fa fa-upload"></i> Upload
        </button>
    </div>
    <div class="w-8/12 shadow px-4 py-2">
      <h2 class="text-sm">Files</h2>
      @foreach ($trainingdocuments as $item)
        <div class="flex gap-2 px-4">
          <div><i class="fa fa-paperclip text-gray-400"></i></div>
          <div class="w-full flex justify-between border-b text-xs">
            <div class="w-10/12 text-blue-800">{{  $item->title }}</div>
            <button class="flex m-1 px-2 text-red-700 gap-2 items-center text-xs" wire:click.prevent="destroy({{$item->id}})" wire:loading.attr="disabled">
              <i class="fa fa-trash-alt"></i> REMOVE
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>