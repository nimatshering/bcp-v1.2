  <div class="container mx-auto">
  <nav class="bg-gray-50 p-3 font-sans w-full mt-2">
    <ol class="list-reset flex text-grey-dark text-xs uppercase pl-4">
      <li><a href="{{ route('admin.dashboard') }}" class="text-blue font-bold">Home</a></li>
      <li><span class="mx-2">/</span></li>
      <li><a href="{{ route('agency.link.category') }}" class="text-blue font-bold">Link Category</a></li>
      <li><span class="mx-2">/</span></li>
      <li>Links</li>
    </ol>
  </nav>
   
    <!--Session message -->
    <x-utilities.messages />

    <div class="mx-auto sm:px-6 lg:px-8 mt-6">
      <div class="flex justify-between">
          <div class="flex flex-col p-2 my-2 font-semibold text-xl">
           {{ App\Models\Linkcategory:: find($this->link_id)->first()->name }}
          </div>
          <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700 mb-6">
              Add New 
          </x-jet-button>
      </div>
      
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200 table-auto">
								<thead class="bg-gray-100">
								<tr class="text-gray-800 text-xs font-semibold uppercase">
									<th scope="col" class="px-6 py-4 text-left tracking-wider">
									</th>
									<th scope="col" class="px-6 py-4 text-left tracking-wider justify-center">
											Links
									</th>

									<th scope="col" class="px-6 py-4 text-right tracking-wider">
											Actions
									</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-gray-200">
									@foreach($links as $item)
										<tr class="hover:bg-gray-50">
											<td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="ml-4 text-sm font-medium text-gray-900">
                          <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-gray-600">
                          </label>
                        </div>
                      </div>
											</td>
											<td class="px-6 py-4 whitespace-nowrap">
												<div class="text-sm text-gray-900">
													{!! $item->name !!}
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
            </div>
          </div>
        </div>
      </div>
        <!-- Add/Edit Modal -->
        @include('backend.livewire.agency.links.partials._addModal')
         <!--Delete Modal -->
        @include('backend.livewire.agency.links.partials._deleteModal')
    </div>
</div>
