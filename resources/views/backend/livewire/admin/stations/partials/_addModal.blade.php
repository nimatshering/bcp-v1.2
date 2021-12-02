 <!-- Show add/Edit Modal -->
 <x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        {{ isset( $this->station->id) ? 'Edit Station' : 'Add Station' }}
    </x-slot>

    <x-slot name="content">
          <!-- Station Type -->
          <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="station_type_id" value="{{ __('Select Station Type') }}" />
              <select wire:model.defer="station.station_type_id" type="text" class="form-control mt-1 block w-full">
                  <option value="">Select Type</option>
                  @foreach ($typelist as $item)
                      <option value="{{ $item->id }}" >{{ $item->name }}</option>
                  @endforeach
              </select>
                <x-jet-input-error for="station.station_type_id" class="mt-2" />
            </div>
        </div>

        <!-- Station ID -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="station_id" value="{{ __('Station ID') }}" />
                <x-jet-input id="station_id" type="text" class="mt-1 block w-full" wire:model.defer="station.station_id" />
                <x-jet-input-error for="station.station_id" class="mt-2" />
            </div>
        </div>

        <!-- Name -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="station.name" />
                <x-jet-input-error for="station.name" class="mt-2" />
            </div>
        </div>

        <!-- Latitude -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="latitude" value="{{ __('Latitude') }}" />
                <x-jet-input id="latitude" type="text" class="mt-1 block w-full" wire:model.defer="station.latitude" />
                <x-jet-input-error for="station.latitude" class="mt-2" />
            </div>
        </div>

        <!-- Longitude -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="longitude" value="{{ __('Longitude') }}" />
                <x-jet-input id="longitude" type="text" class="mt-1 block w-full" wire:model.defer="station.longitude" />
                <x-jet-input-error for="station.longitude" class="mt-2" />
            </div>
        </div>

        <!-- Dzongkhag -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="station.dzongkhag_id" value="{{ __('Dzongkhag') }}" />
              <select wire:model="station.dzongkhag_id" id ='station.dzongkhag_id' name ='station.dzongkhag_id' type="text" class="form-control mt-1 block w-full">
                <option value='' selected>Select Dzongkhag </option>
                  @foreach ($this->dzongkhags as $item)
                    <option value="{{ $item->id }}" >{{ $item->name }}</option>
                  @endforeach
              </select>
                <x-jet-input-error for="station.dzongkhag_id" class="mt-2" />
            </div>
        </div>

        <!-- Gewog -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="station.gewog_id" value="{{ __('Gewog') }}" />
              <select wire:model.defer="station.gewog_id" type="text" class="form-control mt-1 block w-full">
                  <option value='' selected>Select Gewog</option>
                  @foreach ($this->gewogs as $item)
                      <option value="{{ $item->id }}" >{{ $item->name }}</option>
                  @endforeach
              </select>
              <x-jet-input-error for="station.gewog_id" class="mt-2" />
            </div>
        </div>

        <!-- Location -->
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="location" value="{{ __('Location') }}" />
                <x-jet-input id="location" type="text" class="mt-1 block w-full" wire:model.defer="station.location" />
                <x-jet-input-error for="station.location" class="mt-2" />
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