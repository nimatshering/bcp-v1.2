<!-- Show delete Modal -->
<x-jet-confirmation-modal wire:model="confirmItemDeletion">
    <x-slot name="title">
        {{ __('Delete') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete?') }}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('confirmItemDeletion',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-2" wire:click="destroy({{ $confirmItemDeletion }})" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>