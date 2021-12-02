<input
    x-data
    x-ref="input"
    x-init="new Pikaday({ field: $refs.input , format:'D/M/YYYY'})"
    type="text"
    autocomplete="off"
    {{ $attributes }}
    class="flex border-1 border-gray-200 w-full"
    
>

