<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grid;
use App\Models\Station;
use App\Models\Parameter;
use App\Models\WaterObservedData;
use Carbon\Carbon;
use App\Models\ClimateModel;
use App\Models\ClimateObservedData;
use App\Models\ClimateScenerio;
use App\Models\DisasterData;
use App\Models\WaterProjectedData;
use App\Models\Statistic;
use App\Models\Sector;
use App\Models\DisasterImpact;
use App\Models\DisasterType;
use SebastianBergmann\Environment\Console;

class DatareportController extends Controller
{
    
  public $disasterId;
   /*-------------------------------------------------------------------------
    | Show climate data page
    |--------------------------------------------------------------------------
    */
    public function analysedData()
    {
     return view('frontpages.analysed-data.index');
    }


    /*-------------------------------------------------------------------------
    | Show how water observed report page
    |--------------------------------------------------------------------------
    */
    public function waterObservedReport()
    {
        $stationlist = $this->stationlist = Station::where('station_type_id',1)->get();
        $parameterlist = $this->parameterlist = Parameter::where('station_type_id',1)->get();
     return view('frontpages.analysed-data.water-data.observed.index', compact('stationlist','parameterlist'));
    }

    /*-------------------------------------------------------------------------
    | Climate Observed Report Map
    |--------------------------------------------------------------------------
    */
    public function WaterObservedMap()
    {
      $data = [];
      $date = WaterObservedData::select('date_of_reading')
            ->orderBy('date_of_reading','desc')
            ->first();
      $year = Carbon::parse($date['date_of_reading'])->format('Y');
      $tdata = WaterObservedData::join('stations', 'stations.id', '=', 'water_observed_data.station_id')
              ->join('dzongkhags', 'dzongkhags.id', '=', 'stations.dzongkhag_id')
              ->where('water_observed_data.parameter_id', '=', '4')
              ->whereYear('water_observed_data.date_of_reading', '=', $year)
              ->get(['water_observed_data.date_of_reading','stations.name', 'water_observed_data.data','dzongkhags.short_name'])
              ->groupBy('short_name', function($item){
                return (Carbon::parse($item->date_of_reading)->format('Y'));
              });
      
      foreach($tdata as $station){
          //$data[][0] = $station->short_name;
          $data[] = $this->SumData($station);
      }
      return view('frontpages.analysed-data.water-data.observed.map',compact('data','year'));
    }

    
    /*-------------------------------------------------------------------------
    | Show water projected report page
    |--------------------------------------------------------------------------
    */
    public function waterProjectedReport()
    {
        $stationlist = $this->stationlist = Station::where('station_type_id',1)->get();
        $parameterlist = $this->parameterlist = Parameter::where('station_type_id',1)->get();
        $modellist = $this->modellist = ClimateModel::all();
        $sceneriolist = $this->sceneriolist = ClimateScenerio::all();
      return view('frontpages.analysed-data.water-data.projected.index',compact('stationlist','parameterlist','modellist','sceneriolist'));
    }


    /*-------------------------------------------------------------------------
    | Show climate observed report page
    |--------------------------------------------------------------------------
    */
    public function climateObservedReport()
    {
        
        $stationlist = $this->stationlist = Station::where('station_type_id',2)->get();
        $parameterlist = $this->parameterlist = Parameter::where('station_type_id',2)->get();
        return view('frontpages.analysed-data.climate-data.observed.index', compact('stationlist','parameterlist'));
    }

    /*-------------------------------------------------------------------------
    | Climate Observed Report Map
    |--------------------------------------------------------------------------
    */
    public function ClimateObservedMap()
    {
      $data = [];
      $date = WaterObservedData::select('date_of_reading')
            ->orderBy('date_of_reading','desc')
            ->first();
      //dd($date['date_of_reading']);
      $year = Carbon::parse($date['date_of_reading'])->format('Y');
      $tdata = ClimateObservedData::join('stations', 'stations.id', '=', 'climate_observed_data.station_id')
              ->join('dzongkhags', 'dzongkhags.id', '=', 'stations.dzongkhag_id')
              ->where('climate_observed_data.parameter_id', '=', '2')
              ->whereYear('climate_observed_data.date_of_reading', '=', $year)
              ->get(['climate_observed_data.date_of_reading','stations.name', 'climate_observed_data.data','dzongkhags.short_name'])
              ->groupBy('short_name', function($item){
                return (Carbon::parse($item->date_of_reading)->format('Y'));
              });
      
      foreach($tdata as $station){
          //$data[][0] = $station->short_name;
          $data[] = $this->AvgData($station);
      }
      return view('frontpages.analysed-data.climate-data.observed.map',compact('data','year'));
    }

    public function AvgData($data){
      $sum = 0;
      $counter = 0;
      $short_name = '';
      foreach($data as $row){
        $sum += $row->data;
        $short_name = $row->short_name;
        $counter++;
      }
      $return_data = [$short_name,$sum/$counter];
      return $return_data;
    }

    public function SumData($data){
      $sum = 0;
      //$counter = 0;
      $short_name = '';
      foreach($data as $row){
        $sum += $row->data;
        $short_name = $row->short_name;
        //$counter++;
      }
      $return_data = [$short_name,$sum];
      return $return_data;
    }

     
    /*-------------------------------------------------------------------------
    | Show climate reanalyzed report page
    |--------------------------------------------------------------------------
    */
    public function climateReanalyzedReport()
    {
        
        $gridlist = $this->gridlist = Grid::all();
        $parameterlist = $this->parameterlist = Parameter::where('station_type_id',2)->get();
        return view('frontpages.analysed-data.climate-data.reanalyzed.index', compact('gridlist','parameterlist'));
    }


    /*-------------------------------------------------------------------------
    | Show water projected report page
    |--------------------------------------------------------------------------
    */
    public function climateProjectedReport()
    {
        
        $stationlist = $this->stationlist = Station::where('station_type_id',2)->get();
        $parameterlist = $this->parameterlist = Parameter::where('station_type_id',2)->get();
        $modellist = $this->modellist = ClimateModel::all();
        $sceneriolist = $this->sceneriolist = ClimateScenerio::all();
     return view('frontpages.analysed-data.climate-data.projected.index',compact('stationlist','parameterlist','modellist','sceneriolist'));
    }

    /*-------------------------------------------------------------------------
    | Disaster Report Map
    |--------------------------------------------------------------------------
    */
      public function disasterReportMap()
      {
        $disaster = [];
        $data = [];
        $disaster_id = 1;
        $disaster_name = DisasterType::where('id', $disaster_id)
                          ->first()->name;
        $disasterType = DisasterType::select('id','name')->get();
        $date = DisasterData::select('disaster_date')
            ->orderBy('disaster_date','desc')
            ->first();
        //dd($date['disaster_date']);
        $year = Carbon::parse($date['disaster_date'])->format('Y');
        //dd($year);
        $tdata = DisasterData::join('dzongkhags', 'dzongkhags.id', '=', 'disaster_data.dzongkhag_id')
            ->where('disaster_data.type_id', $disaster_id)
            ->whereYear('disaster_data.disaster_date', '=', $year)
            ->where('type_id', '=', $this->disasterId)
            ->get(['disaster_data.disaster_date','dzongkhags.name', 'disaster_data.type_id','dzongkhags.short_name'])
            ->groupBy('short_name', function($item){
              return (Carbon::parse($item->disaster_date)->format('Y'));
            });

        foreach($tdata as $items){
          //$data[][0] = $station->short_name;
          $count = $items->count();
          foreach($items as $item){
            $name = $item->short_name;
          }

          $data[] = [$name, $count];
        }
        $disaster = $data;
        //dd($data);
        return view('frontpages.analysed-data.disaster-data.map',compact('disaster', 'year','disasterType', 'disaster_name'));
      }

        /**
       * Get forest fire for selected dzongkhag using Ajax
       */

      public function mapReport(Request $request)
      {
        $data = [];
        $year = $request->input('year');
        $disaster_id = $request->input('disasterId');
        $disaster_name = DisasterType::where('id', $disaster_id)
                          ->first()->name;
                          //dd($disaster_name);
        $disasterType = DisasterType::select('id','name')->get();
        $tdata = DisasterData::join('dzongkhags', 'dzongkhags.id', '=', 'disaster_data.dzongkhag_id')
            //->where('climate_observed_data.parameter_id', '=', '2')
            ->whereYear('disaster_data.disaster_date', '=', $year)
            ->where('type_id', '=', $disaster_id)
            ->get(['disaster_data.disaster_date','dzongkhags.name', 'disaster_data.type_id','dzongkhags.short_name'])
            ->groupBy('short_name', function($item){
              return (Carbon::parse($item->disaster_date)->format('Y'));
            });

        foreach($tdata as $items){
          //$data[][0] = $station->short_name;
          $count = $items->count();
          foreach($items as $item){
            $name = $item->short_name;
          }

          $data[] = [$name, $count];
        }
        $disaster = $data;
        return view('frontpages.analysed-data.disaster-data.map',compact('disaster', 'disasterType', 'year','disaster_name'));
      }

    /*-------------------------------------------------------------------------
    | Disaster Report Graph
    |--------------------------------------------------------------------------
    */
       public function disasterReportGraph()
    {
     return view('frontpages.analysed-data.disaster-data.graph');
    }


    /*-------------------------------------------------------------------------
|   | Show ghg page
|   |--------------------------------------------------------------------------
    */
    public function ghgReport()
    {
       $sectors = Sector::all();
      return view('frontpages.analysed-data.ghg-data.index', compact('sectors'));
    }


}
