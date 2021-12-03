 <!-- Title -->
  <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="title" value="{{ __('Project Title') }}" class="mb-2"/>
      <x-jet-input name="title" type="text" class="mt-1 block w-full"  value="{{ $programproject->title }}" />
      <x-jet-input-error for="title" class="mt-2" />
  </div>

  <!-- Funding Agency-->
     <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="funding" value="{{ __('Name of Funding Agency') }}" class="mb-2"/>
      <x-jet-input name="funding" type="text" class="mt-1 block w-full"  value="{{ $programproject->funding }}" />
      <x-jet-input-error for="funding" class="mt-2" />
  </div>

    <!-- Amount-->
    <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="amount" value="{{ __('Funding Amount') }}" class="mb-2"/>
      <x-jet-input name="amount" type="text" class="mt-1 block w-full"  value="{{ $programproject->amount }}" />
      <x-jet-input-error for="amount" class="mt-2" />
    </div>

    <!-- Implementing Agency -->
    <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="agency" value="{{ __('Name of Implementing Agency') }}" class="mb-2"/>
      <x-jet-input name="agency" type="text" class="mt-1 block w-full"  value="{{ $programproject->agency }}" />
      <x-jet-input-error for="agency" class="mt-2" />
    </div>

      <!-- Start Date -->
    <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="start_at" value="{{ __('Start Date') }}" class="mb-2"/>
      <x-jet-input name="start_at" type="text" class="datepicker mt-1 block w-full"  value="{{ $programproject->start_at }}" />
      <x-jet-input-error for="start_at" class="mt-2" />
    </div>

      <!-- End Date -->
    <div class="col-span-6 sm:col-span-4 mt-4">
      <x-jet-label for="end_at" value="{{ __('End Date') }}" class="mb-2"/>
      <x-jet-input name="end_at" type="text" class="datepicker mt-1 block w-full"  value="{{ $programproject->end_at }}" />
      <x-jet-input-error for="end_at" class="mt-2" />
    </div>

        <!-- Status -->
        <div class="mt-4">
          <div class="col-span-6 sm:col-span-4">
          <x-jet-label for="status" value="{{ __('Select Project Status') }}" />
          <select name="status" class="form-control  mt-1 block w-full">
            <option value="">Select Status</option>
              <option value="ongoing" @if($programproject->status == 'ongoing') selected @endif> Ongoing</option>
              <option value="completed" @if($programproject->status == 'completed') selected @endif> Completed</option>
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
              <option value="1" @if($programproject->type_id == 1) selected @endif> Mitigation</option>
              <option value="2" @if($programproject->type_id == 2) selected @endif> Adaptation</option>
          </select>
              <x-jet-input-error for="programproject.type_id" class="mt-2" />
          </div>
        </div>

        <!-- Document -->
          <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
              <x-jet-label for="description" value="{{ __('Description') }}" class="font-bold"/>
              <textarea class="form-control" id="description" name="description">@isset($programproject) {{ $programproject->description }} @endisset</textarea>
            </div>
          </div> 

          <input type="hidden" name="category_id" value={{ $programproject->category_id}} />
      
        @livewire('agency.projectdouments', ['projID' => $programproject->id ])