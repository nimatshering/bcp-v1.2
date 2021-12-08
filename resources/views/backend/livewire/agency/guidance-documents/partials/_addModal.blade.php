 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              {{ isset( $this->guidancedocument->id) ? 'Edit Record' : 'Add Record' }}
          </x-slot>

          <x-slot name="content">
              <!-- Title -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="title" value="{{ __('Title') }}" />
                      <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="guidancedocument.title" />
                      <x-jet-input-error for="guidancedocument.title" class="mt-2" />
                  </div>
              </div>

               <!-- Author -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="author" value="{{ __('Author') }}" />
                      <x-jet-input id="author" type="text" class="mt-1 block w-full" wire:model.defer="guidancedocument.author" />
                      <x-jet-input-error for="guidancedocument.author" class="mt-2" />
                  </div>
              </div>

                 <!-- Document -->
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
											wire:model.defer="guidancedocument.description"
											wire:key="trix-content-unique-key"
											>
										</trix-editor>
									</div>
								</div>
							</div>
            <x-jet-input-error for="guidancedocument.description" class="mt-2" />
            </div> 

                <!-- document -->
              <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="document" value="{{ __('Uplaod Document') }}" />
                    <x-jet-input id="document" type="file" class="form-control mt-1 block w-full" wire:model.defer="document" />
                    <x-jet-input-error for="document" class="mt-2" />
                </div>
              </div> 

                <!-- Published Date -->
               <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="published_at" value="{{ __('Publish Date') }}" />
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD' })" class="form-control" id="published_at" wire:model.lazy="guidancedocument.published_at"/>
                <x-jet-input-error for="guidancedocument.published_at" class="mt-2 form-control" />
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