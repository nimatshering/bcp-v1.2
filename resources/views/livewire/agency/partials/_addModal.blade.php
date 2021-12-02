 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
             <h2 class="font-bold">
               {{ isset( $this->programproject->id) ? 'Edit - Program & Project' : 'Add - Program & Project' }}
               </h2> 
              <hr class="my-2">
          </x-slot>

          <x-slot name="content">
              <!-- Title -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="title" value="{{ __('Project Title') }}" />
                      <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="programproject.title" />
                      <x-jet-input-error for="programproject.title" class="mt-2" />
                  </div>
              </div>

               <!-- Funding Agency -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="funding" value="{{ __('Name of Funding Agency') }}" />
                      <x-jet-input id="funding" type="text" class="mt-1 block w-full" wire:model.defer="programproject.funding" />
                      <x-jet-input-error for="programproject.funding" class="mt-2" />
                  </div>
              </div>

               <!-- Amount -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="amount" value="{{ __('Funding Amount') }}" />
                      <x-jet-input id="amount" type="text" class="mt-1 block w-full" wire:model.defer="programproject.amount" />
                      <x-jet-input-error for="programproject.amount" class="mt-2" />
                  </div>
              </div>

                <!-- Implementing Agency -->
              <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="agency" value="{{ __('Name of Implementing Agency ') }}" />
                      <x-jet-input id="agency" type="text" class="mt-1 block w-full" wire:model.defer="programproject.agency" />
                      <x-jet-input-error for="programproject.agency" class="mt-2" />
                  </div>
              </div>

              <!-- Start Date -->
               <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                 <div class="w-full mt-4">
                    <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="start_at" value="{{ __('Start Date') }}" />
                    <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD' })" class="form-control" id="start_at" wire:model.lazy="programproject.start_at"/>
                    <x-jet-input-error for="programproject.start_at" class="mt-2 form-control" />
                    </div>
                  </div>  

                  <!-- End Date -->
                <div class="w-full mt-4">
                    <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="end_at" value="{{ __('End Date') }}" />
                    <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD' })" class="form-control" id="end_at" wire:model.lazy="programproject.end_at"/>
                    <x-jet-input-error for="programproject.end_at" class="mt-2 form-control" />
                    </div>
                  </div> 
                </div> 

               <!-- Status -->
                <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="status" value="{{ __('Select Project Status') }}" />
                    <select wire:model.defer="programproject.status"  type="text" class="form-control mt-1 block w-full">
                        <option value="">Select Project Status</option>
                            <option value="ongoing" >Ongoing</option>
                            <option value="completed" >Completed</option>
                    </select>
                      <x-jet-input-error for="programproject.type_id" class="mt-2" />
                  </div>
                </div>



              	<!-- Type -->
                <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="type_id" value="{{ __('Select Project Type') }}" />
                    <select wire:model.defer="programproject.type_id"  type="text" class="form-control mt-1 block w-full">
                        <option value="">Select Document Type</option>
                            <option value="1" >Mitigation</option>
                            <option value="2" >Adaptation</option>
                    </select>
                      <x-jet-input-error for="programproject.type_id" class="mt-2" />
                  </div>
                </div>

              
                 <!-- Document -->
            <div class="mt-4">
            <x-jet-label for="description" value="{{ __('Document Description') }}" />
							<div class="rounded-md shadow-sm">
								<div class="mt-1 bg-white">                      
									<div class="body-content" wire:ignore>                            
										<trix-editor
											class="trix-content"
											x-ref="trix"
											x-data
											x-on:trix-change="$dispatch('input', event.target.value)"
											wire:model.defer="programproject.description"
											wire:key="trix-content-unique-key"
											>
										</trix-editor>
									</div>
								</div>
							</div>
            <x-jet-input-error for="programproject.description" class="mt-2" />
            </div> 
            {{-- Project -Project  - {!! $this->projID !!} --}}
            @livewire('agency.projectdouments', ['name' => "Nima"])
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