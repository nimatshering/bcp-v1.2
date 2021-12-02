 <!-- Title -->
  <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="name" value="{{ __('Training Name') }}" class="mb-2"/>
      <x-jet-input name="name" type="text" class="mt-1 block w-full" />
      <x-jet-input-error for="name" class="mt-2" />
  </div>

  <!-- videolink-->
     <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="videolink" value="{{ __('Video Link') }}" class="mb-2"/>
      <x-jet-input name="videolink" type="text" class="mt-1 block w-full" />
      <x-jet-input-error for="videolink" class="mt-2" />
  </div>

    <!-- Other link-->
    <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="otherlink" value="{{ __('Other Link') }}" class="mb-2"/>
      <x-jet-input name="otherlink" type="text" class="mt-1 block w-full"/>
      <x-jet-input-error for="otherlink" class="mt-2" />
    </div>

    <!-- Document -->
      <div class="mt-4">
        <div class="col-span-6 sm:col-span-4">
          <x-jet-label for="description" value="{{ __('Description') }}" class="font-bold"/>
          <textarea class="form-control trix-content" id="description" name="description"></textarea>
        </div>
      </div> 

      @isset($trainingmaterial)
          @php $trainingID = $trainingmaterial->id+1; @endphp
      @else
          @php $trainingID = 0; @endphp
      @endisset

    @livewire('agency.trainingdocuments', ['trainID' => $trainingID ])