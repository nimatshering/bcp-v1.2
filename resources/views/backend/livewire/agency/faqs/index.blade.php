@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/css/pikaday.min.css" integrity="sha512-yFCbJ3qagxwPUSHYXjtyRbuo5Fhehd+MCLMALPAUar02PsqX3LVI5RlwXygrBTyIqizspUEMtp0XWEUwb/huUQ==" crossorigin="anonymous" /> 
 @endpush
<div class="container py-4 mx-auto px-20">
    <nav class="bg-gray-100 p-3 rounded font-sans w-full m-4">
    <ol class="list-reset flex text-grey-dark">
      <li><a href="{{ route('admin.dashboard') }}" class="text-blue font-bold">Home</a></li>
      <li><span class="mx-2">/</span></li>
      <li>FAQs</li>
    </ol>
  </nav>


    <!--Session message -->
    <x-utilities.messages />

    <div class="mx-auto sm:px-6 lg:px-8">
      <div class="flex justify-between">
          <div class="flex flex-col p-2 my-2 font-semibold text-xl">
            Faq
          </div>
          <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700 mb-6">
              Add New 
          </x-jet-button>
      </div>
      
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 table-auto">
              <thead class="bg-gray-100">
                <tr class="text-gray-800 text-xs font-semibold uppercase">
                  <th scope="col" class="px-6 py-4 text-left tracking-wider">
                  </th>
                  <th scope="col" class="px-6 py-4 text-left tracking-wider">
                      Questions
                  </th>
                  <th scope="col" class="px-6 py-4 text-right tracking-wider">
                      Actions
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              @foreach($faqs as $item)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        <label class="inline-flex items-center">
                          <input type="checkbox" class="form-checkbox text-gray-600">
                        </label>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {!! \Illuminate\Support\Str::limit($item->question, 40) !!}            
                  </div>
                </td>

                <td class="flex justify-end gap-2 p-2">
                  <button wire:click="showEditModal({{ $item->id }})" class="px-4 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-gray-500 hover:text-gray-200">
                      Edit
                  </button>                                    

                  <x-jet-danger-button wire:click="showDeleteModal({{ $item->id }})" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                  </x-jet-danger-button>  
                </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
        <!-- Add/Edit Modal -->
        @include('backend.livewire.agency.faqs.partials._addModal')
         <!--Delete Modal -->
        @include('backend.livewire.agency.faqs.partials._deleteModal')
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/pikaday.min.js" integrity="sha512-AWC8WaJpos1L8xD++XDtqY3znmqhqDY/o4KZ3wo7kmt1Hx6YjP4ZqPnYDrLg1ymG6iidGzq/UKHS/MxBwVAlwQ==" crossorigin="anonymous"></script>
@endpush
