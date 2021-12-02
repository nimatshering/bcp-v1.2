 <!-- Import from Excel File-->
 <div class="flex w-full">
   <form action="{{ route('agency.ghg.xls.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <label for="datafile">Import Excel Data</label>
    <div class="flex gap-2">
        <input type="file" name="datafile" class="form-control">
        <button type="submit" class="bg-gray-200 px-4 my-1 rounded text-gray-900 text-xs uppercase shadow">
          Import
        </button>
      </div>
  </form>
</div>