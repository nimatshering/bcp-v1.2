<div class="container py-4 mx-auto px-20">
    <nav class="bg-gray-100 p-3 rounded font-sans w-full m-4">
    <ol class="list-reset flex text-grey-dark">
      <li><a href="{{ route('admin.dashboard') }}" class="text-blue font-bold">Home</a></li>
      <li><span class="mx-2">/</span></li>
      <li>Greenhouse Gas data</li>
    </ol>
  </nav>


    <!--Session message -->
    <x-utilities.messages />

    <!--Import Excel Data -->
    @if (isset($erros) && $erros->any()))
    <div>
      @foreach ($errors->all() as $error)
          {{ $error }}
      @endforeach
    </div>
    @endif
    
    <div class="p-3 rounded font-sans w-full m-4">
      @include('backend.livewire.agency.ghg-data.partials._ghgExcelUpload')
    </div>

    <div class="mx-auto sm:px-6 lg:px-8">
      <div class="flex justify-between">
          <div class="flex flex-col p-2 my-2 font-semibold text-xl">
            Greenhouse Gas Data
          </div>
          <div>
          <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700 mb-6">
              Add New 
          </x-jet-button>
          </div>
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
                          <th scope="col" class="px-6 py-4 text-left tracking-wider">
                              Year
                          </th>

                          <th scope="col" class="flex px-6 py-4 text-left tracking-wider ">
                              Sector
                          </th>

                          
                          <th scope="col" class="px-6 py-4 text-left tracking-wider">
                              CO2-equiv (value)
                          </th>

                          <th scope="col" class="px-6 py-4 text-left tracking-wider">
                              Data source
                          </th>
                          <th scope="col" class="px-6 py-4 text-right tracking-wider">
                              Actions
                          </th>
                          
                          </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                          @foreach($datalist as $item)
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
                                  {!! $item->year !!}
                              </div>
                          </td>

                          <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900">
                                  {!! optional(App\Models\Sector::find($item->sector_id))->name; !!}
                              </div>
                          </td>

                          <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900">
                                   {!! $item->data !!} 
                              </div>
                          </td>

                          <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900">
                                  {!! $item->data_source !!}
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
        <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              {{ isset( $this->data->id) ? 'Edit Data' : 'Add Data' }}
          </x-slot>

          <x-slot name="content">
                <!-- Sector -->
                <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="sector_id" value="{{ __('Select Sector') }}" />
                    <select wire:model.defer="data.sector_id" type="text" class="form-control mt-1 block w-full">
                        <option value="">Select Sector</option>
                        @foreach ($sectorlist as $item)
                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach
                    </select>
                      <x-jet-input-error for="data.sector_id" class="mt-2" />
                  </div>
                </div>

            <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="year" value="{{ __('Year') }}" />
                      <x-jet-input id="year" type="number" class="mt-1 block w-full" wire:model.defer="data.year" />
                      <x-jet-input-error for="data.year" class="mt-2" />
                  </div>
              </div>

              <!-- Data -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="data" value="{{ __('Value (CO2-equiv)') }}" />
                      <x-jet-input id="data" type="number" step="any" class="mt-1 block w-full" wire:model.defer="data.data" />
                      <x-jet-input-error for="data.data" class="mt-2" />
                  </div>
              </div>

              <!-- Data Source -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="data_source" value="{{ __('Data Source') }}" />
                      <x-jet-input id="data_source" type="text" class="mt-1 block w-full" wire:model.defer="data.data_source" />
                      <x-jet-input-error for="data.data_source" class="mt-2" />
                  </div>
              </div>

          </x-slot>

          <x-slot name="footer">
              <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                  {{ __('Cancel') }}
              </x-jet-secondary-button>

              <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
                  {{ __('Save') }}
              </x-jet-button>
          </x-slot>
      </x-jet-dialog-modal>
         <!-- Show delete Modal -->
      <x-jet-confirmation-modal wire:model="confirmItemDeletion">
          <x-slot name="title">
              {{ __('Delete') }}
          </x-slot>

          <x-slot name="content">
              {{ __('Are you sure you want to delete?') }}
          </x-slot>

          <x-slot name="footer">
              <x-jet-secondary-button wire:click="$set('confirmItemDeletion',false)" wire:loading.attr="disabled">
                  {{ __('Cancel') }}
              </x-jet-secondary-button>

              <x-jet-danger-button class="ml-2" wire:click="destroy({{ $confirmItemDeletion }})" wire:loading.attr="disabled">
                  {{ __('Delete') }}
              </x-jet-danger-button>
          </x-slot>
      </x-jet-confirmation-modal></div>
</div>

