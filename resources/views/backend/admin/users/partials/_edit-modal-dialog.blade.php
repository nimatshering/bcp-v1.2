<div class="" x-data="{ open: false }">
  <x-utilities.modals.open-button btntext="edit" btncolor="green"/>
      <!-- Modal Dialog  -->
  <div class="flex flex-wrap mx-auto">
    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open"  >
      <div class="h-auto w-full mx-2 text-left bg-white rounded-lg shadow-xl md:max-w-2xl md:mx-0" @click.away="open = false">
        <div class="flex justify-between bg-gray-50 rounded-lg">
          <div class="flex justify-between items-center px-6 py-4">
            <p class="text-xl font-bold">Edit - Users</p>
          </div>
            <!-- Modal close button  -->
          <x-utilities.modals.close-button/>
        </div>
        <div class="px-6 py-4">
          <form method="POST" action="{{ route('admin.users.update',$user->id) }}">
            @method('PATCH')
            @include('backend.admin.users.partials._form')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>