 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              {{ isset( $this->faq->id) ? 'Edit' : 'Add' }}
          </x-slot>

          <x-slot name="content">
            <!-- Question -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="question" value="{{ __('Question') }}" />
                      <x-jet-input id="question" type="text" class="mt-1 block w-full" wire:model.defer="faq.question" />
                      <x-jet-input-error for="faq.question" class="mt-2" />
                  </div>
              </div>

            <!-- Answer -->
            <div class="mt-4">
            <x-jet-label for="content" value="{{ __('Answer') }}" />
							<div class="rounded-md shadow-sm">
								<div class="mt-1 bg-white">                      
									<div class="body-content" wire:ignore>                            
										<trix-editor
											class="trix-content"
											x-ref="trix"
											x-data
											x-on:trix-change="$dispatch('input', event.target.value)"
											wire:model.defer="faq.answer"
											wire:key="trix-content-unique-key">
										</trix-editor>
									</div>
								</div>
							</div>
              <x-jet-input-error for="faq.answer" class="mt-2" />
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