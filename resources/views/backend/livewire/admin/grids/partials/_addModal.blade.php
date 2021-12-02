 <!-- Show add/Edit Modal -->
 <x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        {{ isset( $this->grid->id) ? 'Edit Grid' : 'Add Grid' }}
    </x-slot>

    <x-slot name="content">
          <!-- Grid Number -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="grid_no" value="{{ __('Grid Number') }}" />
                <x-jet-input id="grid_no" type="text" class="mt-1 block w-full" wire:model.defer="grid.grid_no" />
                <x-jet-input-error for="grid.grid_no" class="mt-2" />
            </div>
        </div>

        <!-- North Latitude -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="north_latitude" value="{{ __('North Latitude') }}" />
                <x-jet-input id="north_latitude" type="text" class="mt-1 block w-full" wire:model.defer="grid.north_latitude" />
                <x-jet-input-error for="grid.north_latitude" class="mt-2" />
            </div>
        </div>

        <!-- North Longitude -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="north_longitude" value="{{ __('North Longitude') }}" />
                <x-jet-input id="north_longitude" type="text" class="mt-1 block w-full" wire:model.defer="grid.north_longitude" />
                <x-jet-input-error for="grid.north_longitude" class="mt-2" />
            </div>
        </div>

        <!-- South Latitude -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="south_latitude" value="{{ __('South Latitude') }}" />
                <x-jet-input id="south_latitude" type="text" class="mt-1 block w-full" wire:model.defer="grid.south_latitude" />
                <x-jet-input-error for="grid.south_latitude" class="mt-2" />
            </div>
        </div>

        <!-- South Longitude -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="south_longitude" value="{{ __('South Longitude') }}" />
                <x-jet-input id="south_longitude" type="text" class="mt-1 block w-full" wire:model.defer="grid.south_longitude" />
                <x-jet-input-error for="grid.south_longitude" class="mt-2" />
            </div>
        </div>

        <!-- East Latitude -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="east_latitude" value="{{ __('East Latitude') }}" />
                <x-jet-input id="east_latitude" type="text" class="mt-1 block w-full" wire:model.defer="grid.east_latitude" />
                <x-jet-input-error for="grid.east_latitude" class="mt-2" />
            </div>
        </div>

        <!-- East Longitude -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="east_longitude" value="{{ __('East Longitude') }}" />
                <x-jet-input id="east_longitude" type="text" class="mt-1 block w-full" wire:model.defer="grid.east_longitude" />
                <x-jet-input-error for="grid.east_longitude" class="mt-2" />
            </div>
        </div>

        <!-- West Latitude -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="west_latitude" value="{{ __('West Latitude') }}" />
                <x-jet-input id="west_latitude" type="text" class="mt-1 block w-full" wire:model.defer="grid.west_latitude" />
                <x-jet-input-error for="grid.west_latitude" class="mt-2" />
            </div>
        </div>

        <!-- West Longitude -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="west_longitude" value="{{ __('West Longitude') }}" />
                <x-jet-input id="west_longitude" type="text" class="mt-1 block w-full" wire:model.defer="grid.west_longitude" />
                <x-jet-input-error for="grid.west_longitude" class="mt-2" />
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