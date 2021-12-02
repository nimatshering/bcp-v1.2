 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd" maxWidth="5xl">
          <x-slot name="title">
              {{ isset( $this->post->id) ? 'Edit Record' : 'Add Record' }}
          </x-slot>

          <x-slot name="content">
              <!-- Title -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="title" value="{{ __('Title') }}" />
                      <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="post.title" />
                      <x-jet-input-error for="post.title" class="mt-2" />
                  </div>
              </div>
							     <!-- Summary -->
            <div class="mt-4">
            <x-jet-label for="summary" value="{{ __('Summary') }}" />
							<div class="rounded-md shadow-sm">
								<div class="mt-1 bg-white">                      
									<div class="body-content" wire:ignore>                            
										<trix-editor
											class="trix-content"
											x-ref="trix"
											x-data
											x-on:trix-change="$dispatch('input', event.target.value)"
											wire:model.defer="post.summary"
											wire:key="trix-content-unique-key">
										</trix-editor>
									</div>
								</div>
							</div>
           	 <x-jet-input-error for="post.summary" class="mt-2" />
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
											x-on:trix-change="$dispatch('input', event.target.value)"
											wire:model.defer="post.description"
											wire:key="trix-content-unique-key">
										</trix-editor>
									</div>
								</div>
							</div>
           	 <x-jet-input-error for="post.description" class="mt-2" />
            </div> 

						 <!-- Author -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="author" value="{{ __('Author') }}" />
                      <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="post.author" />
                      <x-jet-input-error for="post.author" class="mt-2" />
                  </div>
              </div>

                <!-- Photo -->
              <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="photo" value="{{ __('Uplod Photo') }}" />
                    <x-jet-input type="file" class="form-control mt-1 block w-full" wire:model.defer="photo" />
                    <x-jet-input-error for="photo" class="mt-2" />
                </div>
              </div> 

              <!-- Published Date -->
              <div class="mt-4">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="published_at" value="{{ __('Publish Date') }}" />
                	<input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD' })" class="form-control" wire:model.lazy="post.published_at"/>
                <x-jet-input-error for="post.published_at" class="mt-2 form-control" />
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