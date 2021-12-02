<div class="py-10">
  @can('is-forum')
    <header class="relative py-6 flex content-center justify-center">
      <div class="absolute top-0 w-full h-48 bg-center bg-cover" style='background-image: url("/assets/img/bg.jpg");'>
        <span id="blackOverlay" class="w-full h-full absolute opacity-60 bg-black"></span>
      </div>
      <div class="container relative pb-4">
        <div class="flex flex-wrap">
          <div class="container w-full lg:w-6/12 lg:text-center text-white">
            <div class="flex flex-row">
              <div class="hidden md:block">
                <a href="{{ route('forum.dashboard') }}">
                  <img alt="..." src="{{ asset('assets/img/logo.png')}}" class=" max-w-full h-20" />
                </a>
              </div>
              <div class="px-4 text-center md:text-left">
                <h1 class="font-bold md:font-extrabold uppercase lg:text-2xl">
                  National Environment Commission
                </h1>
                <p class="font-dzongkha mt-2 text-white lg:text-2xl">
                  རྒྱལ་ཡོངས་མཐའ་འཁོར་གནས་སྟངས་ལྷན་ཚོགས།
                </p>
              </div>
            </div>
          </div>

          <!-- navigation menu -->
          <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
            <div class="flex flex-col gap-2">
              <div class="lg:pl-24 lg:text-left text-white">
                <h1 class="font-bold md:font-extrabold uppercase lg:text-4xl text-center">
                  Bhutan Climate Platform
                </h1>
                <p class="hidden lg:block mt-2 text-center">
                  A knowledge base for climate change initatives in Bhutan.
                </p>
              </div>

              <div class="flex justify-center pt-4 gap-4">
                <a href="{{ route('forum.dashboard') }}">
                  <h2
                    class="items-center px-6 py-2 font-light text-sm text-gray-700 bg-yellow-400 hover:bg-yellow-200 hover:text-gray-700 rounded-full">
                    <i class="fa fa-long-arrow-alt-left pr-4"></i> Home</h2>
                </a>
                @if (Auth::check())
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                    <h2
                      class="items-center px-6 py-2 font-light text-sm text-gray-700 bg-blue-400 hover:bg-yellow-200 hover:text-gray-700 rounded-full">
                      Logout</h2>
                  </button>
                  </form>
                @else 
                  <a href="{{ route('register') }}">
                    <h2
                      class="items-center px-6 py-2 font-light text-sm text-gray-700 bg-green-400 hover:bg-yellow-200 hover:text-gray-700 rounded-full">
                      Register</h2>
                  </a>

                  <a href="{{ route('login') }}">
                    <h2
                      class="items-center px-6 py-2 font-light text-sm text-gray-700 bg-blue-400 hover:bg-yellow-200 hover:text-gray-700 rounded-full">
                      Login</h2>
                  </a>
                @endif
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
  @endcan

 

  <div class="container py-4 mx-auto px-20">
    <nav class="bg-gray-100 p-3 rounded font-sans w-full m-4">
      <ol class="list-reset flex text-grey-dark">
        <li><a href="{{ route('forum.dashboard') }}" class="text-blue font-bold">Home</a></li>
        <li><span class="mx-2">/</span></li>
        <li>Discussion</li>
      </ol>
    </nav>
    <!--Session message -->
    <x-utilities.messages />
    <div class="mx-auto sm:px-6 lg:px-8">
      <div class="flex justify-between">
        <div class="flex flex-col p-2 my-2 font-semibold text-xl uppercase">
          Discussion 
        </div>
        <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700 mb-6">
          New Post
        </x-jet-button>
      </div>
      
      <div class="flex flex-col">
           <div id="fb-root"></div>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-100">
                  <tr class="text-gray-800 text-xs font-semibold uppercase">
                    <th scope="col" class="px-6 py-4 text-left tracking-wider">
                    </th>
                    <th scope="col" class="px-6 py-4 text-left tracking-wider">
                        Discussion Topic
                    </th>
                    <th scope="col" class="px-6 py-4 text-left tracking-wider">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-4 text-right tracking-wider">
                        Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @foreach($discussions as $item)
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                              <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-gray-600">
                              </label>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          {!! $item->topic !!}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          {!! $item->category->name !!}
                        </div>
                      </td>
                      <td class="flex justify-end gap-2 p-2">
                        <button wire:click="showEditModal({{ $item->id }})" class="px-4 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-gray-500 hover:text-gray-200">
                            Edit
                        </button>                                    

                        <x-jet-danger-button wire:click="showDeleteModal({{ $item->id }})" wire:loading.attr="disabled">
                          {{ __('Delete') }}
                        </x-jet-danger-button>  
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="p-4">
                {{ $discussions->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
        <!-- Add/Edit Modal -->
        @include('backend.livewire.forum.partials._add')
        <!--Delete Modal -->
        @include('backend.livewire.forum.partials._delete')
    </div>
  </div>
</div>


    



