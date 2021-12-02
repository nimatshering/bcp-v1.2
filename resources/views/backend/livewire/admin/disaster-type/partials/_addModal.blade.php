 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              {{ isset( $this->disastertype->id) ? 'Edit Disaster type' : 'Add Disaster Type' }}
          </x-slot>

          <x-slot name="content">
              <!-- Title -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="name" value="{{ __('Name') }}" />
                      <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="disastertype.name" />
                      <x-jet-input-error for="disastertype.name" class="mt-2" />
                  </div>
              </div>
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="name" value="{{ __('Details') }}" />
                      <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="disastertype.details" />
                      <x-jet-input-error for="disastertype.details" class="mt-2" />
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