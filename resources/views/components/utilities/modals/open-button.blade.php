@props(['btntext','btncolor'])
 <button class="px-6 py-2 text-white bg-{{ $btncolor }}-500 font-bold rounded text-xs uppercase hover:bg-{{ $btncolor }}-600 focus:no-outline" @click="open = true">
    {{ $btntext }} 
</button>