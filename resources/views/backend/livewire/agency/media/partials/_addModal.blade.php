 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd" maxWidth="3xl">
          <x-slot name="title">
              {{ isset( $this->media->id) ? 'Edit' : 'Add' }}
          </x-slot>

          <x-slot name="content">
              <!-- Title -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="title" value="{{ __('Title') }}" />
                      <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="media.title" />
                      <x-jet-input-error for="media.title" class="mt-2" />
                  </div>
              </div>

               <!-- Video link -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="videolink" value="{{ __('Video Link') }}" />
                      <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="media.videolink" />
                      <x-jet-input-error for="media.videolink" class="mt-2" />
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