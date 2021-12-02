 <!-- Title -->
  <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="title" value="{{ __('Project Title') }}" class="mb-2"/>
      <x-jet-input name="title" type="text" class="mt-1 block w-full" />
      <x-jet-input-error for="title" class="mt-2" />
  </div>

  <!-- Funding Agency-->
     <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="funding" value="{{ __('Name of Funding Agency') }}" class="mb-2"/>
      <x-jet-input name="funding" type="text" class="mt-1 block w-full" />
      <x-jet-input-error for="funding" class="mt-2" />
  </div>

    <!-- Amount-->
    <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="amount" value="{{ __('Funding Amount') }}" class="mb-2"/>
      <x-jet-input name="amount" type="text" class="mt-1 block w-full"/>
      <x-jet-input-error for="amount" class="mt-2" />
    </div>

    <!-- Implementing Agency -->
    <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="agency" value="{{ __('Name of Implementing Agency') }}" class="mb-2"/>
      <x-jet-input name="agency" type="text" class="mt-1 block w-full"/>
      <x-jet-input-error for="agency" class="mt-2" />
    </div>

      <!-- Start Date -->
    <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="start_at" value="{{ __('Start Date') }}" class="mb-2"/>
      <x-jet-input name="start_at" type="date" class="mt-1 block w-full"/>
      <x-jet-input-error for="start_at" class="mt-2" />
    </div>

      <!-- End Date -->
    <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="end_at" value="{{ __('End Date') }}" class="mb-2"/>
      <x-jet-input name="end_at" type="date" class="mt-1 block w-full"/>
      <x-jet-input-error for="end_at" class="mt-2" />
    </div>

    <!-- Status -->
    <div class="mt-4">
      <div class="col-span-6 sm:col-span-4">
      <x-jet-label for="status" value="{{ __('Select Project Status') }}" />
      <select name="status" class="form-control  mt-1 block w-full">
        <option value="">Select Document Type</option>
          <option value="1"> Ongoing</option>
          <option value="2"> Completed</option>
      </select>
          <x-jet-input-error for="programproject.status" class="mt-2" />
      </div>
    </div>


    <!-- Type -->
    <div class="mt-4">
      <div class="col-span-6 sm:col-span-4">
      <x-jet-label for="type_id" value="{{ __('Select Project Type') }}" />
      <select name="type_id" class="form-control  mt-1 block w-full">
        <option value="">Select Document Type</option>
          <option value="1"> Mitigation</option>
          <option value="2"> Adaptation</option>
      </select>
          <x-jet-input-error for="programproject.type_id" class="mt-2" />
      </div>
    </div>

    <!-- Document -->
      <div class="mt-4">
        <div class="col-span-6 sm:col-span-4">
          <x-jet-label for="description" value="{{ __('Description') }}" class="font-bold"/>
          <textarea class="form-control trix-content" id="description" name="description"></textarea>
        </div>
      </div> 
      <input type="hidden" name="category_id" value={{ $proj->category_id}} />
      
      @isset($proj)
          @php $projID = $proj->id+1; @endphp
      @else
          @php $projID = 0; @endphp
      @endisset

    @livewire('agency.projectdouments', ['projID' => $projID ])