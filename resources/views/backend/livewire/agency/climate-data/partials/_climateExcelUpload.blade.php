<!-- Import from Excel File-->
<div class="flex w-full">
   <form action="{{ route('agency.climate.observed.xls.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <label for="climatedata"><b>Import Excel Data</b></label>
    <div class="flex gap-2">
      <select name ="station" id="station" class="form-control">
        <option>Choose a station</option>
        @foreach($stationlist as $item) 
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
      </select>
      <select name ="parameter" id="parameter" class="form-control">
        <option>Choose Parameter</option>
        @foreach($parameterlist as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
      </select>
      <input type="file" name="climatedatafile" class="form-control">
        <button type="submit" class="bg-gray-200 px-4 my-1 rounded text-gray-900 text-xs uppercase shadow">
          Import
        </button>
    </div>
    
      
  </form>
  
</div>
<div class="flex flex-1 bg-green-700 hover:bg-green-600 px-4 py-2 rounded my-2 w-4/12 text-white font-bold text-xs uppercase">
        <a href="/uploads/dataImportFiles/template_climate_observed.xlsx" >Download Format for life import</a>
</div>