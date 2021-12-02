<x-app-layout>
<div class="container py-4 px-6 mx-auto">
  <nav class="bg-gray-100 p-2 rounded font-sans w-full mb-2">
    <ol class="list-reset flex text-grey-dark uppercase text-sm">
      <li><a href="{{ route('agency.dashboard') }}" class="text-blue">Home</a></li>
      <li><span class="mx-2">/</span></li>
      <li class="font-bold">Program & Project</li>
    </ol>
  </nav>
    <!--Session message -->
    <x-utilities.messages />
  <div class="px-2 mt-2">
    <div class="flex justify-between items-center uppercase">
        <div class="font-bold">{{ \App\Models\Programprojectcategory::findOrFail($catID)->name }}</div>
        <div class="p-2 my-2 font-semibold uppercase">
          <a href="{{ route('agency.trainingmaterial.create')}}" class="px-4 py-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-blue-500 hover:text-gray-200">
             <i class="fa fa-plus mr-2"></i> Add Project / Program
          </a>  
        </div>
    </div>
    
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-gray-100">
              <tr class="text-gray-800 text-xs font-semibold uppercase">
                <th scope="col" class="px-6 py-4 text-left tracking-wider">
                </th>
                <th scope="col" class="px-6 py-4 text-left tracking-wider">
                    Project Title
                </th>
                <th scope="col" class="flex px-6 py-4 text-left tracking-wider">
                    Funding Agency
                </th>
                <th scope="col" class="px-6 py-4 text-left tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-4 text-left tracking-wider">
                    Publication Date
                </th>
                <th scope="col" class="px-6 py-4 text-right tracking-wider">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($programprojects as $item)
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
                  {!! \Illuminate\Support\Str::limit($item->title, 40) !!}            
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  {!! \Illuminate\Support\Str::limit($item->agency, 40) !!}            
                </div>
              </td>

               <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  {!! $item->status !!}            
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  {!! $item->created_at->format('d-M-Y') !!}
                </div>
              </td>
              <td class="flex justify-end gap-2 p-2">
                <a href="{{ route('agency.trainingmaterial.edit', $item->id)}}" class="px-4 py-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-gray-500 hover:text-gray-200">
                    Edit
                </a>                                     

                {{-- <x-jet-danger-button wire:click="showDeleteModal({{ $item->id }})" wire:loading.attr="disabled">
                  {{ __('Delete') }}
                </x-jet-danger-button>   --}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div>
</div>
</x-app-layout>