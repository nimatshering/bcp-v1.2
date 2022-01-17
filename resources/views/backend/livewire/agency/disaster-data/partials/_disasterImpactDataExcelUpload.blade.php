 <!-- Import from Excel File-->
 <div class="flex w-full">
   <form action="{{ route('agency.disaster.impact.xls.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <label for="ghgdata">Import Excel Data</label>
    <div class="flex gap-2">
    
        <input type="file" name="datafile" class="form-control">
        <input type="hidden" name="disasterId" class="form-control" value="{{$disaster_id}}">
        <input type="hidden" name="dzongkhagId" class="form-control" value="{{$dzongkhag_id}}">
        <button type="submit" class="bg-gray-200 px-4 my-1 rounded text-gray-900 text-xs uppercase shadow">
          Import
        </button>
      </div>
  </form>
</div>
<div class="flex flex-1 bg-green-700 hover:bg-green-600 px-4 py-2 rounded my-2 w-4/12 text-white font-bold text-xs uppercase">
        <a href="/uploads/dataImportFiles/template_disaster_impact_data.xlsx" >Download Format for Data Import</a>
</div>