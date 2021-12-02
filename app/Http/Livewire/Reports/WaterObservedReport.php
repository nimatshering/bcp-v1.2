<?php

namespace App\Http\Livewire\Reports;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\Models\Station;
use App\Models\Parameter;
use App\Models\WaterObservedData;
use App\Models\Statistic;
use Carbon\Carbon;


use Livewire\Component;

class WaterObservedReport extends Component
{
    public $station, $parameter, $start_yr, $end_yr, $statistic, $stationlist, $parameterlist;
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
        return view('livewire.reports.water-observed-report', compact('statistics'));
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
    public function getQ5($data){
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
    public function fetchWaterObservedData(Request $request)
    { 
      $start_yr = $request->input('start_year');
      $end_yr = $request->input('end_year');
      $parameter = $request->input('parameter');
      $station = $request->input('station');

      $water_line_data = WaterObservedData::select('id','date_of_reading', 'data')
                    ->where('station_id',$station)->where('parameter_id',$parameter)
                    ->whereYear('date_of_reading','>=',$start_yr)
                    ->whereYear('date_of_reading','<=',$end_yr)
                    ->orderBy('date_of_reading')
                    ->get()
                    ->groupBy(function($item){
                        return (Carbon::parse($item->date_of_reading)->format('Y'));
                        });

      //Prepare for Line Graph
      foreach($water_line_data as $index => $dataitem){
        $yearlist[]=$index;
        foreach($dataitem as $item){
            $dataset[$index][]= (float)$item->data;
        }
      }

        //chart dataset 
      foreach($yearlist as $index => $year){        
        $final_dataset[] = array(
            "name" => $yearlist[$index],
            "data" => $dataset[$year]
        );
    }

      $data = $final_dataset;
      return Response:: json($data);
    }

    /*--------------------------------------------------------------------------
    | fetchWaterObservedDataBoxPlot
    |--------------------------------------------------------------------------
    */
    public function fetchWaterObservedDataBoxPlot(Request $request){
      $start_yr = $request->input('start_year');
      $end_yr = $request->input('end_year');
      $parameter = $request->input('parameter');
      $station = $request->input('station');

      $waterdata = WaterObservedData::select('id','date_of_reading', 'data')
                                      ->where('station_id',$station)
                                      ->where('parameter_id',$parameter)
                                      ->whereYear('date_of_reading','>=',$start_yr)
                                      ->whereYear('date_of_reading','<=',$end_yr)
                                      ->orderBy('date_of_reading')->get()
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
      foreach($waterdata as $rdata => $datas){
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
  public function fetchWaterObservedDataRegression(Request $request)
  {
      $start_yr = $request->input('start_year');
      $end_yr = $request->input('end_year');
      $parameter = $request->input('parameter');
      $station = $request->input('station');
      $month = $request->input('month');

      $climatedata = WaterObservedData::select('id','date_of_reading', 'data')
                                            ->where('station_id',$station)->where('parameter_id',$parameter)
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
      //dd($climatedata);
      //BoxPlot data preparation
      //$counter = 0;
      foreach($climatedata[$month] as $rdata) {
          $dataset[]=[(\Carbon\Carbon::parse($rdata->date_of_reading))->year,$rdata->data];
          $dataYear[] = (\Carbon\Carbon::parse($rdata->date_of_reading))->year;
          $dataValue[] = $rdata->data;
          //$counter++;
      }
      $data[0] = $dataset;
      $mn = $this->calcMean($dataValue);
      $variance = $this->calcVariance($dataset, $mn);
      $reg = $this->regression($dataValue, $dataYear);
      //dd($reg);
      $data[1] = $mn;;

      $data[2] = $variance;
      $data[3] = sqrt($variance);
      $data[4] = $reg[0];//Line data
      $data[5] = $reg[1];//r = correlation coefficient
      $data[6] = $reg[2]; // a 
      $data[7] = $reg[3]; //b
      //dd($data);
      return Response:: json($data);
    }

    
  /*--------------------------------------------------------------------------
  | calcMean
  |--------------------------------------------------------------------------
  */
  public function calcMean($arr)
  {
      $sum = 0;
      $len = count($arr);
      foreach($arr as $data){
            $sum = $sum + (float)$data;
      }
      $mn = $sum/$len;
      return $mn;
  }

  /*--------------------------------------------------------------------------
  | calculate Variance
  |--------------------------------------------------------------------------
  */
  public function calcVariance($arr, $mean){
    $sumsqr = 0;
    $len = count($arr);
    foreach($arr as $data) {
        $deviation = (float)$data - $mean;
        $sumsqr = $sumsqr + ($deviation * $deviation);
    }
    $variance = $sumsqr/$len;
    return $variance;
  }

  

  
  // correlation coefficient.
  public function correlationCoefficient($X, $Y, $n)
  {
      $sum_X = 0;$sum_Y = 0; $sum_XY = 0;
      $squareSum_X = 0; $squareSum_Y = 0;
  
      for ($i = 0; $i < $n; $i++)
      {
          // sum of elements of array X.
          $sum_X = $sum_X + $X[$i];
  
          // sum of elements of array Y.
          $sum_Y = $sum_Y + $Y[$i];
  
          // sum of X[i] * Y[i].
          $sum_XY = $sum_XY + $X[$i] * $Y[$i];
  
          // sum of square of array elements.
          $squareSum_X = $squareSum_X +
                        $X[$i] * $X[$i];
          $squareSum_Y = $squareSum_Y +
                        $Y[$i] * $Y[$i];
      }
  
      // use formula for calculating
      // correlation coefficient.
      $corr = (float)($n * $sum_XY - $sum_X * $sum_Y) /
          sqrt(($n * $squareSum_X - $sum_X * $sum_X) *
                ($n * $squareSum_Y - $sum_Y * $sum_Y));
  
      return $corr;
  }

  /* Regression Line */
  public function regression($arrY, $arrX) {
      //console.log(arrWeight);
    $r=0; $sy=0; $sx=0; $b=0; $a=0; $meanX=0; $meanY=0;
    //r = jStat.corrcoeff(arrX, arrY);
    $r = $this->correlationCoefficient($arrX, $arrY, count($arrX));
    //meanY = jStat(arrY).mean();
    $meanY = $this->calcMean($arrY);
    //meanX = jStat(arrX).mean();
    $meanX = $this->calcMean($arrX);
    //sy = jStat.stdev(arrY);
    $sy = sqrt($this->calcVariance($arrY,$meanY));
    //sx = jStat.stdev(arrX);
    $sx = $this->calcVariance($arrX,$meanX);
    $b = $r * ($sy / $sx);
    $a = $meanY - $meanX * $b;
    //Set up a line
    //let y1, y2, x1, x2;
    //dd($arrX);
    $x1 = $arrX[0];//jStat.min(arrX);
    $x2 = $arrX[count($arrX)-1];//jStat.max(arrX);
    $y1 = $a + $b * $x1;
    $y2 = $a + $b * $x2;
    $line = [
      [$x1, $y1],
      [$x2, $y2]
    ];
    $regData[0] = $line;
    $regData[1] = $r;
    $regData[2] = $a;
    $regData[3] = $b;
    return $regData;
  }
}
