<?php

namespace App\Http\Livewire\Reports;
use Illuminate\Support\Facades\Response;
use Livewire\Component;
use App\Models\Sector;
use App\Models\Greenhousegas;
use Illuminate\Http\Request;
use Arr;

class GhgReports extends Component
{
    public $genReport = false;
    public $ghg;
    public $ghg_data;

     protected $rules = [
        'ghg.sector_id' => 'required', 
        'ghg.start_yr' => 'required',
        'ghg.end_yr' => 'required',
    ];
    
     /*--------------------------------------------------------------------------
    |  render
    |--------------------------------------------------------------------------
    */
    public function render()
    {
        $sectors = Sector::all();
        return view('livewire.reports.ghg-reports',compact('sectors'));
    }


    /*--------------------------------------------------------------------------
    |  Fetch Report data
    |--------------------------------------------------------------------------
    */
    public function fetchGhgData(Request $request)
    {
      $yearstart = $request->input('start_year');
      $yearend = $request->input('end_year');
      
      $ghgdata = Greenhousegas::select('year','sector_id','data')
                ->where('year','>=',$yearstart)
                ->where('year','<=',$yearend)
                ->orderBy('year')
                ->get()
                ->groupBy('year');

        //seperate into respective arrays required for chart display        
      foreach($ghgdata as $index => $dataitem){
        $yearlist[]=$index;
        foreach($dataitem as $item){
            $sectorlist[]= $item->sector_id;
            $dataset[$index][]= (float)$item->data;
        }
      }
      
      //chart dataset 
      foreach($yearlist as $index => $year){        
        $dataseries[] = array(
            "name" => $yearlist[$index],
            "data" => $dataset[$year]
        );
    }
        //sector name list
      foreach(array_unique($sectorlist) as $sec){
            $sectornamelist[] = Sector::find($sec)->name;
         }

      //combine array for json response
      $chartData[] = $sectornamelist;
      $chartData['dataset'] = $dataseries;

    return Response:: json($chartData);
    }


    public function fetchDataDzongkhag(Request $request)
    {

        $indicatorName = $indicator->name;
        $paraNameList = $indicator->parameters->pluck('name')->toArray();
        $paraIDList = $indicator->parameters->pluck('id')->toArray();

        $av_data = Dzongkhagdata::where('dzongkhag_id',$dzongkhag_id)->whereIn('para_id',$paraIDList)->pluck('value','para_id');
        $values = $av_data->values()->toArray();
        $para_keys = $av_data->keys()->toArray();
        $parameterNames = Parameter::whereIn('id',$para_keys)->pluck('name')->toArray();
        $data = array_combine($parameterNames, $values);
      
        return Response::json($data);
    }
}