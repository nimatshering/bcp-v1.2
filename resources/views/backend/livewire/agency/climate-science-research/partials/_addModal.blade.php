 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              {{ isset( $this->publication->id) ? 'Edit Publication' : 'Add Publication' }}
          </x-slot>

          <x-slot name="content">
              <!-- Title -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="title" value="{{ __('Title') }}" />
                      <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="publication.title" />
                      <x-jet-input-error for="publication.title" class="mt-2" />
                  </div>
              </div>

               <!-- Author -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="author" value="{{ __('Author Name') }}" />
                      <x-jet-input id="author" type="text" class="mt-1 block w-full" wire:model.defer="publication.author" />
                      <x-jet-input-error for="publication.author" class="mt-2" />
                  </div>
              </div>

               <!-- Agency -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="agency" value="{{ __('Agency Name') }}" />
                      <x-jet-input id="agency" type="text" class="mt-1 block w-full" wire:model.defer="publication.agency" />
                      <x-jet-input-error for="publication.agency" class="mt-2" />
                  </div>
              </div>

               <!-- abstract -->
           <div class="mt-4">
            <x-jet-label for="abstract" value="{{ __('Abstract') }}" />
							<div class="rounded-md shadow-sm">
								<div class="mt-1 bg-white">                      
									<div class="body-content" wire:ignore>                            
										<trix-editor
											class="trix-content"
											x-ref="trix"
											x-data
											x-on:trix-change="$dispatch('input', event.target.value)"
											wire:model.defer="publication.abstract"
											wire:key="trix-abstract-unique-key"
											>
										</trix-editor>
									</div>
								</div>
							</div>
            <x-jet-input-error for="publication.abstract" class="mt-2" />
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
											wire:model.defer="publication.description"
											wire:key="trix-content-unique-key"
											>
										</trix-editor>
									</div>
								</div>
							</div>
            <x-jet-input-error for="publication.description" class="mt-2" />
            </div> 

            	<!-- Type -->
                <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="subcategory_id" value="{{ __('Select Document Type') }}" />
                    <select wire:model.defer="publication.subcategory_id"  type="text" class="form-control mt-1 block w-full">
                        <option value="">Select Document Type</option>
                        @foreach ($subcategories as $item)
                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach
                    </select>
                      <x-jet-input-error for="publication.subcategory_id" class="mt-2" />
                  </div>
                </div>

							<!-- document -->
						<div class="mt-4">
							<div class="col-span-6 sm:col-span-4">
								<x-jet-label for="document" value="{{ __('Uplod Document') }}" />
								<x-jet-input id="document" type="file" class="mt-1 block w-full form-control" wire:model.defer="document" />
								<x-jet-input-error for="document" class="mt-2" />
							</div>
						</div> 

            <!-- Published Date -->
            <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="published_at" value="{{ __('Publish Date') }}" />
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD' })" class="form-control" id="published_at" wire:model.lazy="publication.published_at"/>
                <x-jet-input-error for="publication.published_at" class="mt-2" />
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