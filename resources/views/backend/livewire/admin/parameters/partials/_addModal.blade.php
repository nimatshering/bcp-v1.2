 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              {{ isset( $this->parameter->id) ? 'Edit Parameter' : 'Add Parameter' }}
          </x-slot>

          <x-slot name="content">
            <!-- Station Type -->
            <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="station_type_id" value="{{ __('Select Station Type') }}" />
                <select wire:model.defer="parameter.station_type_id" type="text" class="form-control mt-1 block w-full">
                    <option value="">Select Type</option>
                    @foreach ($typelist as $item)
                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                    @endforeach
                </select>
                    <x-jet-input-error for="parameter.station_type_id" class="mt-2" />
                </div>
            </div>
                <!-- name -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="name" value="{{ __('Name') }}" />
                      <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="parameter.name" />
                      <x-jet-input-error for="parameter.name" class="mt-2" />
                  </div>
              </div>

              <!-- unit -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="unit" value="{{ __('Unit') }}" />
                      <x-jet-input id="unit" type="text" class="mt-1 block w-full" wire:model.defer="parameter.unit" />
                      <x-jet-input-error for="parameter.unit" class="mt-2" />
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