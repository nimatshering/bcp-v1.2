<div class="" x-data="{ open: false }">
  <x-utilities.modals.open-button btntext="Delete" btncolor="red"/>
      <!-- Modal Dialog  -->
  <div class="flex flex-wrap mx-auto">
    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open"  >
      <div class="h-auto w-full mx-2 text-left bg-white rounded-lg shadow-xl md:max-w-2xl md:mx-0" @click.away="open = false">
        <div class="flex justify-between bg-gray-50 rounded-lg">
          <div class="flex justify-between items-center px-6 py-4">
            <p class="text-xl font-bold">Delete - User</p>
          </div>
            <!-- Modal close button  -->
          <x-utilities.modals.close-button/>
        </div>
        <div class="px-6 py-4">
          <h1 class="py-2">Are you sure you want to permanently delete the selected user?</h1>
          <h1 class="py-2">{{ $user->name }}</h1>
          <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <span class="flex justify-end">
                <button type="submit" class="px-10 py-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-red-500 hover:text-gray-200">
                  Yes
              </button> 
              </span>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>