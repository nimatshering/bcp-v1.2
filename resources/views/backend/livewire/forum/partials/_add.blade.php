 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              {{ isset( $this->discussion->id) ? 'Edit Forum Post' : 'Add Forum Post' }}
          </x-slot>

          <x-slot name="content">

            <!-- Category -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="category_id" value="{{ __('Category') }}" />
                         <select class="form-control" name="category_id" wire:model="discussion.category_id" >
                            <option value="" selected> - Select Category -</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                      <x-jet-input-error for="discussion.category_id" class="mt-2" />
                  </div>
              </div>
              
              <!-- Topic -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="topic" value="{{ __('Topic') }}" />
                      <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="discussion.topic" />
                      <x-jet-input-error for="discussion.topic" class="mt-2" />
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
                        wire:model.defer="discussion.summary"
                        wire:key="trix-content-unique-key">
                      </trix-editor>
                    </div>
                  </div>
                </div>
            <x-jet-input-error for="discussion.summary" class="mt-2" />
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
                        wire:model.defer="discussion.content"
                        wire:key="trix-content-unique-key">
                      </trix-editor>
                    </div>
                  </div>
                </div>
              <x-jet-input-error for="discussion.content" class="mt-2" />
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