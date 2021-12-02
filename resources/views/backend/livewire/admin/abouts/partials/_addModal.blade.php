 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              {{ isset( $this->about->id) ? 'Edit' : 'Add' }}
          </x-slot>

          <x-slot name="content">
            <!-- Question -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="title" value="{{ __('Title') }}" />
                      <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="about.title" />
                      <x-jet-input-error for="about.title" class="mt-2" />
                  </div>
              </div>

            <!-- Content -->
            <div class="mt-4">
            <x-jet-label for="content" value="{{ __('Content') }}" />
							<div class="rounded-md shadow-sm">
								<div class="mt-1 bg-white">                      
									<div class="body-content" wire:ignore>                            
										<trix-editor
											class="trix-content"
											x-ref="trix"
											x-data
											x-on:trix-change="$dispatch('input', event.target.value)"
											wire:model.defer="about.content"
											wire:key="trix-content-unique-key">
										</trix-editor>
									</div>
								</div>
							</div>
              <x-jet-input-error for="about.content" class="mt-2" />
            </div> 

             <!-- Photo -->
          <!-- Display image -->
              @if (isset($this->about->id))
                  <div class="col-span-6 sm:col-span-4 mt-4">
                      <x-jet-label value="{{ __('About Photo') }}"  class="py-2"/>
                      <img src=" {{ asset('uploads/'.$this->about->photo)}}" alt="about">
                  </div>
              @endif

              @if ($photo)
                  <div class="col-span-6 sm:col-span-4 mt-4">
                      <x-jet-label value="{{ __('Photo Preview') }}" />
                      <img src="{{ $photo->temporaryUrl() }}" alt="New Photo" class="rounded-lg h-32 w-60 object-cover">
                  </div>
              @endif

              <!-- Photo -->
            <div class="mt-4">
              <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="photo" value="{{ __('Uplod Photo') }}" />
                  <x-jet-input type="file" class="form-control mt-1 block w-full" wire:model.defer="photo" />
                  <x-jet-input-error for="photo" class="mt-2" />
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