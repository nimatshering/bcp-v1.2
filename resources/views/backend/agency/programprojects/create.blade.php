<x-app-layout>
 @push('styles')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 @endpush
<nav class="bg-gray-100 p-2 rounded font-sans w-full mb-2">
    <ol class="list-reset flex text-grey-dark uppercase text-sm">
      <li><a href="{{ route('agency.dashboard') }}" class="text-blue">Home</a></li>
      <li><span class="mx-2">/</span></li>
      <li><a href="{{ route('agency.programprojects.show',$proj->id)}}" class="text-blue">Program/Project</a></li>
      <li><span class="mx-2">/</span></li>
      <li>Add New</li>
    </ol>
  </nav>
<div class="mb-20">
    <div class="container mx-auto w-10/12 my-10">
    <x-utilities.messages />
    <div class="flex flex-col pb-20">
       <form action="{{ route('agency.programprojects.store') }}" method="POST">
        @csrf
        @include('backend.agency.programprojects.partials._form')
        <div class=" mt-6 flex gap-2 justify-between">
          <button type ='submit' class="uppercase font-bold text-xs rounded px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white">
              {{ __('Save') }}
          </button>
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