 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              {{ isset( $this->category->id) ? 'Edit Category' : 'Add Category' }}
          </x-slot>

          <x-slot name="content">
              <!-- iocn -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="icon" value="{{ __('Icon') }}" />
                      <x-jet-input id="icon" type="text" class="mt-1 block w-full" wire:model.defer="category.icon" />
                      <x-jet-input-error for="category.icon" class="mt-2" />
                  </div>
              </div>
              
              <!-- Title -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="name" value="{{ __('Name') }}" />
                      <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="category.name" />
                      <x-jet-input-error for="category.name" class="mt-2" />
                  </div>
              </div>

                <!-- Definition -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="definition" value="{{ __('Definition') }}" />
                      <x-jet-input id="definition" type="text" class="mt-1 block w-full" wire:model.defer="category.definition" />
                      <x-jet-input-error for="category.definition" class="mt-2" />
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