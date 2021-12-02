 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              {{ isset( $this->expert->id) ? 'Edit' : 'Add' }}
          </x-slot>

          <x-slot name="content">
              <!-- Name -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="name" value="{{ __('Name') }}" />
                      <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="expert.name" />
                      <x-jet-input-error for="expert.name" class="mt-2" />
                  </div>
              </div>

              <!-- Field -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="field" value="{{ __('Field of Expertise') }}" />
                      <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="expert.field" />
                      <x-jet-input-error for="expert.field" class="mt-2" />
                  </div>
              </div>

               <!-- Qualification -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="qualification" value="{{ __('Qualification') }}" />
                      <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="expert.qualification" />
                      <x-jet-input-error for="expert.qualification" class="mt-2" />
                  </div>
              </div>

                 <!-- Description -->
            <div class="mt-4">
            <x-jet-label for="description" value="{{ __('Description') }}" />
							<div class="rounded-md shadow-sm">
								<div class="mt-1 bg-white">                      
									<div class="body-content" wire:ignore>                            
										<trix-editor
											class="trix-content"
											x-ref="trix"
											x-data
											x-on:trix-change="$dispatch('input', expert.target.value)"
											wire:model.defer="expert.description"
											wire:key="trix-content-unique-key">
										</trix-editor>
									</div>
								</div>
							</div>
           	 <x-jet-input-error for="expert.description" class="mt-2" />
            </div> 

             <!-- Photo -->
            @isset($expert)
            @if(!is_null($expert->photo))
              <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                      <img src="{{ asset('uploads/'.$expert->photo)}}" class="h-52 w-auto">
                </div>
              </div>
            @endif
           @endisset

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