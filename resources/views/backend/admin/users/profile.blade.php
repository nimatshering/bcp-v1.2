<x-app-layout>
    <x-jet-authentication-card>
        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('user-profile-information.update') }}">
            @csrf
            @method("PUT")

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ auth()->user()->name }}" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ auth()->user()->email }}" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>
