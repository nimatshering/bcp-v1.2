 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
             <h2 class="font-bold">
               {{ isset( $this->projectdoument->id) ? 'Edit - Program & Project Documents' : 'Add - Program & Project Documents' }}
               </h2> 
              <hr class="my-2">
          </x-slot>

          <x-slot name="content">
              <!-- Title -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="title" value="{{ __('Project Title') }}" />
                      <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="projectdoument.title" />
                      <x-jet-input-error for="projectdoument.title" class="mt-2" />
                  </div>
              </div>

              <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="document" value="{{ __('Uplod Document') }}" />
                    <x-jet-input id="document" type="file" class="form-control mt-1 block w-full" wire:model.defer="document" />
                    <x-jet-input-error for="document" class="mt-2" />
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