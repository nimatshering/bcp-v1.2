    @csrf
     <div class="mt-1">
        <x-jet-label for="name" value="{{ __('Name') }}" />
        <input id="name" class="form-control block mt-1 w-full" type="name" name="name" @isset($user) value="{{ $user->name }}"@endisset  required autocomplete="name" />
    </div>

    <div class="mt-4 font-semibold">
        <x-jet-label for="email" value="{{ __('Email') }}" />
        <input id="email" class="form-control block mt-1 w-full" type="email" name="email"  @isset($user) value="{{ $user->email }}"@endisset  required autocomplete="email" />
    </div>

    @isset($create)
      <div class="mt-4">
          <x-jet-label for="password" value="{{ __('Password') }}" />
          <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
      </div>

      <div class="mt-4 font-semibold">
          <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
          <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
      </div>
    @endisset

    <div class="mt-4 text-xs upp">
      <x-jet-label for="roles" value="{{ __('Roles') }}" />
      <div class="flex items-center gap-2">
        @foreach ($roles as $role)
          <input class="rounded-full"  name="roles[]" 
            type="checkbox" value="{{$role->id}}" id="{{ $role->name }}"
            @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset>
          <label for="{{$role->name }}" class="rounded-full ">
          {{ $role->name }}
        </label>
        @endforeach
      </div>
    </div>
   

    <div class="flex items-center justify-end mt-4">
        <x-jet-button class="ml-4 bg-blue-500 hover:bg-blue-600">
            {{ __('Save') }}
        </x-jet-button>
    </div>