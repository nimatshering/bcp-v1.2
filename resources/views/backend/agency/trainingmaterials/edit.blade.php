<x-app-layout>
    <nav class="bg-gray-100 p-2 rounded font-sans w-full mb-2">
    <ol class="list-reset flex text-grey-dark uppercase text-sm">
      <li><a href="{{ route('agency.dashboard') }}" class="text-blue">Home</a></li>
      <li><span class="mx-2">/</span></li>
      <li><a href="{{ route('agency.trainingmaterial.index') }}" class="text-blue">Training Materials</a></li>
      <li><span class="mx-2">/</span></li>
    </ol>
  </nav>
<div class="mb-20">
    <div class="container mx-auto w-10/12 my-10">
    <x-utilities.messages />
     <div class="flex my-1 justify-end">
        <form action="{{ route('agency.trainingmaterial.destroy',$trainingmaterial->id) }}" method="POST" >
          @csrf
          @method('DELETE')
          <button type="submit" class="uppercase font-bold text-xs rounded px-6 py-3 bg-red-600 hover:bg-red-500 text-white" onclick="return confirm('Sure Want Delete?')">Delete</button>
        </form>
    </div>

    <div class="flex flex-col pb-20">
       <form action="{{ route('agency.trainingmaterial.update',$trainingmaterial->id) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @include('backend.agency.trainingmaterials.partials._editform')
       
        <div class=" mt-6 flex gap-2 justify-between">
              <button type ='submit' class="uppercase font-bold rounded px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white">
                  {{ __('Save') }}
              </button>
              <a href="{{ route('agency.trainingmaterial.index')}}" class="bg-gray-600 hover:bg-gray-500 uppercase font-bold px-6 py-2 rounded text-white">
                  <i class="fa fa-arrow-left mr-4"></i>{{ __('Back') }}
              </a>
        </div>
      </form>
    </div>
  </div>
</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
   <script>
        ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
        console.error( error );
        } );
   </script>
    @endpush
</x-app-layout>