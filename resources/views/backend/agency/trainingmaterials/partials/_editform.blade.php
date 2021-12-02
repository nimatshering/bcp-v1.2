 <!-- Title -->
  <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="name" value="{{ __('Training Material Name') }}" class="mb-2"/>
      <x-jet-input name="name" type="text" class="mt-1 block w-full"  value="{{ $trainingmaterial->name }}" />
      <x-jet-input-error for="name" class="mt-2" />
  </div>

  <!-- Video Link-->
     <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="videolink" value="{{ __('Video Link') }}" class="mb-2"/>
      <x-jet-input name="videolink" type="text" class="mt-1 block w-full"  value="{{ $trainingmaterial->videolink }}" />
      <x-jet-input-error for="videolink" class="mt-2" />
  </div>

    <!-- Other Link-->
    <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="otherlink" value="{{ __('Other Link') }}" class="mb-2"/>
      <x-jet-input name="otherlink" type="text" class="mt-1 block w-full"  value="{{ $trainingmaterial->otherlink }}" />
      <x-jet-input-error for="otherlink" class="mt-2" />
    </div>

    <!-- Description -->
    <div class="mt-4">
      <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="description" value="{{ __('Description') }}" class="font-bold"/>
        <textarea class="form-control trix-content" id="description" name="description">@isset($trainingmaterial) {{ $trainingmaterial->description }} @endisset</textarea>
      </div>
    </div> 

    @livewire('agency.trainingdocuments', ['trainID' => $trainingmaterial->id ])