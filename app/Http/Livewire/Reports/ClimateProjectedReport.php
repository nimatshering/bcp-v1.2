<?php

namespace App\Http\Livewire\Reports;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\Models\Station;
use App\Models\Statistic;
use App\Models\Parameter;
use App\Models\ClimateModel;
use App\Models\ClimateScenerio;
use App\Models\ClimateProjectedData;
use Carbon\Carbon;

use Livewire\Component;

class ClimateProjectedReport extends Component
{
    public $station, $parameter, $start_yr, $end_yr, $statistic, $stationlist, $parameterlist, $modellist, $sceneriolist, $model, $scenerio;
    public $dataset, $label;

    public $selectedStatistic = null;
    public $selectedMonth = false;
    public $stat;
    public $month;

  /*--------------------------------------------------------------------------
  | render
  |--------------------------------------------------------------------------
  */
    public function render()
    {
        $statistics = Statistic::all();
        return view('livewire.reports.climate-projected-report', compact('statistics'));
    }


    /*--------------------------------------------------------------------------
    | updatedSelectedStatistic
    |--------------------------------------------------------------------------
    */    
    public function updatedSelectedStatistic($stat)
    {
      if(($stat=='linear') || ($stat=='polynomial'))
        $this->selectedMonth = true;
      else
       $this->selectedMonth = false;
    }
    
  /*--------------------------------------------------------------------------
  | CalcQuartiles
  |--------------------------------------------------------------------------
  */
    public function CalcQuartiles($data){
      foreach($data as $monthly_data){
          $q5_data[]= $this->getQ5($monthly_data);
      }
      return $q5_data;
    }

  /*--------------------------------------------------------------------------
  | getQ5
  |--------------------------------------------------------------------------
  */
    public function getQ5($data) {
      $tsorted = collect($data)->sort()->toArray();
      foreach($tsorted as $no){
          $sorted[] = $no;
      }
      $q1=$this->Quartile($sorted,0.25);
      $q2=$this->Quartile($sorted,0.50);
      $q3=$this->Quartile($sorted,0.75);
      $qs=[min($sorted),$q1,$q2,$q3,max($sorted)];
      return $qs;
    }

  /*--------------------------------------------------------------------------
  | Quartile
  |--------------------------------------------------------------------------
  */
    function Quartile($data, $q) {
        $pos = (count($data) + 1) * $q;
        if ( fmod($pos, 1) == 0){
            return $data[$pos -1];
        }else{
            $base = floor($pos);
            return ($data[$base] + $data[$base-1])/2;
        }
      }
    

    /*--------------------------------------------------------------------------
    | AJAX Fetch Chart data
    |--------------------------------------------------------------------------
    */
    public function fetchClimateProjectedData(Request $request)
    {
      $start_yr = $request->input('start_year');
      $end_yr = $request->input('end_year');
      $parameter = $request->input('parameter');
      $station = $request->input('station');
      $model = $request->input('model');
      $scenerio = $request->input('scenerio');

      $climate_line_data = ClimateProjectedData::select('id','date_of_reading', 'data')
                          ->where('station_id',$station)
                          ->where('parameter_id',$parameter)
                          ->where('model_id',$model)
                          ->where('scenerio_id',$scenerio)
                          ->whereYear('date_of_reading','>=',$start_yr)
                          ->whereYear('date_of_reading','<=',$end_yr)
                          ->orderBy('date_of_reading')
                          ->get()
                          ->groupBy(function($item){
                              return (Carbon::parse($item->date_of_reading)->format('Y'));
                            });
     $line_dataset=[];
    //Prepare for Line Graph
    foreach($climate_line_data as $ldata => $data_line){
      $line_datalabel[]=$ldata;
      foreach($data_line as $l_row){
          $line_dataset[$ldata][]= (float)$l_row->data;
      }
    }
    //Arrange for graph
    //$yr = $start_yr;
    for($i = 0; $i < count($line_datalabel); $i++){
      $yr = $line_datalabel[$i];
        $final_dataset[] = array(
            "name" => $line_datalabel[$i],
            "data" => $line_dataset[$yr]
        );
        $yr++;
    }
    $data = $final_dataset;
    return Response:: json($data);
  }

  /*--------------------------------------------------------------------------
  | fetchClimateProjectedDataBoxPlot
  |--------------------------------------------------------------------------
  */
  public function fetchClimateProjectedDataBoxPlot(Request $request) {
      $start_yr = $request->input('start_year');
      $end_yr = $request->input('end_year');
      $parameter = $request->input('parameter');
      $station = $request->input('station');
      $model = $request->input('model');
      $scenerio = $request->input('scenerio');

      $climatedata = ClimateProjectedData::select('id','date_of_reading', 'data')
                                            ->where('station_id',$station)
                                            ->where('parameter_id',$parameter)
                                            ->where('model_id',$model)
                                            ->where('scenerio_id',$scenerio)
                                            ->whereYear('date_of_reading','>=',$start_yr)
                                            ->whereYear('date_of_reading','<=',$end_yr)
                                            ->orderBy('date_of_reading')
                                            ->get()
                                            ->groupBy(function($item){
                                            return (Carbon::parse($item->date_of_reading)->format('M'));
                                        });

      /* Arrange data into label and dataset */
      $data = [];
      $dataset=[];
      $datalabel=[];
      $line_dataset=[];
      $line_datalabel=[];

      //BoxPlot data preparation
      foreach($climatedata as $rdata => $datas){
        $datalabel[]=$rdata;
        foreach($datas as $row){
            $dataset[$rdata][]= (float)$row->data;
        }
    }
    $dataset = $this->CalcQuartiles($dataset);
    $data = $dataset;
    return Response:: json($data);
   }


  /*--------------------------------------------------------------------------
  | fetchClimateObservedDataRegression
  |--------------------------------------------------------------------------
  */
  public function fetchClimateProjectedDataRegression(Request $request)
  {
      $start_yr = $request->input('start_year');
      $end_yr = $request->input('end_year');
      $parameter = $request->input('parameter');
      $station = $request->input('station');
      $month = $request->input('month');
      $model = $request->input('model');
      $scenerio = $request->input('scenerio');

      $climatedata = ClimateProjectedData::select('id','date_of_reading', 'data')
                                            ->where('station_id',$station)
                                            ->where('parameter_id',$parameter)
                                            ->where('model_id',$model)
                                            ->where('scenerio_id',$scenerio)
                                            ->whereYear('date_of_reading','>=',$start_yr)
                                            ->whereYear('date_of_reading','<=',$end_yr)
                                            ->orderBy('date_of_reading')
                                            ->get()
                                            ->groupBy(function($item){
                                                  return ((Carbon::parse($item->date_of_reading)->format('M')));
                                              });

     /* Arrange data into label and dataset */
      $data = [];
      $dataset=[];
      $datalabel=[];
      $line_dataset=[];
      $line_datalabel=[];
      
      //BoxPlot data preparation
      $counter = 0;
      foreach($climatedata[$month] as $rdata) {
          $dataset[]=[(\Carbon\Carbon::parse($rdata->date_of_reading))->year,$rdata->data];
          $counter++;
          /* $datalabel[]=$rdata;
          foreach($datas as $row)
          {
              $dataset[$rdata][]= (float)$row->data;
          } */
      }
      //dd($dataset);
      //$dataset = $this->CalcQuartiles($dataset);
      $data[0] = $dataset;
      //dd($dataset);
      $mn = $this->calcMean($dataset);
      $variance = $this->calcVariance($dataset, $mn);
      //dd($mn);
      
      $data[1] = $mn;//200;
      $data[2] = $variance;
      $data[3] = sqrt($variance);
      return Response:: json($data);
    }

    
  /*--------------------------------------------------------------------------
  | calcMean
  |--------------------------------------------------------------------------
  */
  public function calcMean($dataset)
  {
      $sum = 0;
      $len = count($dataset);
      foreach($dataset as $data){
            $sum = $sum + (float)$data[1];
      }
      $mn = $sum/$len;
      return $mn;
  }

  /*--------------------------------------------------------------------------
  | calcVariance
  |--------------------------------------------------------------------------
  */
  public function calcVariance($dataset, $mean){
    $sumsqr = 0;
    $len = count($dataset);
    foreach($dataset as $data) {
        $deviation = (float)$data[1] - $mean;
        $sumsqr = $sumsqr + ($deviation * $deviation);
    }
    $variance = $sumsqr/$len;
    return $variance;
  }
  }
