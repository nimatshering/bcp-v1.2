<x-app-layout>
 @push('styles')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 @endpush
<nav class="bg-gray-100 p-2 rounded font-sans w-full mb-2">
    <ol class="list-reset flex text-grey-dark uppercase text-sm">
      <li><a href="{{ route('agency.dashboard') }}" class="text-blue">Home</a></li>
      <li><span class="mx-2">/</span></li>
      <li><a href="{{ route('agency.programprojects.show',$programproject->category_id)}}" class="text-blue">
              {{ \App\Models\Programprojectcategory::findOrFail($programproject->category_id)->name }}
      </a></li>
    </ol>
  </nav>
<div class="mb-20">
    <div class="container mx-auto w-10/12 my-10">
    <x-utilities.messages />
    <div class="flex my-2 justify-end">
        <form action="{{ route('agency.programprojects.destroy',$programproject->id) }}" method="POST" >
          @csrf
          @method('DELETE')
          <button type="submit" class="uppercase font-bold text-xs rounded px-6 py-3 bg-red-600 hover:bg-red-500 text-white" onclick="return confirm('Sure Want Delete?')">Delete</button>
        </form>
    </div>

    <div class="flex flex-col pb-20">
       <form action="{{ route('agency.programprojects.update',$programproject->id) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @include('backend.agency.programprojects.partials._editform')
       
        <div class=" mt-6 flex gap-2 justify-between">
              <button type ='submit' class="uppercase font-bold text-xs rounded px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white">
                  {{ __('Update') }}
              </button>
              <a href="{{ route('agency.programprojects.show',$programproject->category_id)}}" class="bg-gray-600 hover:bg-gray-500 uppercase font-bold px-6 py-2 rounded text-white">
                  <i class="fa fa-arrow-left mr-4"></i>{{ __('Back') }}
              </a>
        </div>
      </form>
    </div>
  </div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>

    <script type="text/javascript">
       $(function() {
               $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
       });
   </script>

    <script>
        ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
        console.error( error );
        } );
    </script>
@endpush
</x-app-layout>