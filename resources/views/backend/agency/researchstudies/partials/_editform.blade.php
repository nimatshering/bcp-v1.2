 <!-- Title -->
  <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="name" value="{{ __('Research Study Name') }}" class="mb-2"/>
      <x-jet-input name="name" type="text" class="mt-1 block w-full"  value="{{ $researchstudy->name }}" />
      <x-jet-input-error for="name" class="mt-2" />
  </div>

    <!-- Description -->
    <div class="mt-4">
      <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="description" value="{{ __('Description') }}" class="font-bold"/>
        <textarea class="form-control trix-content" id="description" name="description">@isset($researchstudy) {{ $researchstudy->description }} @endisset</textarea>
      </div>
    </div> 


    @livewire('agency.researchstudydocuments', ['researchID' => $researchstudy->id ])