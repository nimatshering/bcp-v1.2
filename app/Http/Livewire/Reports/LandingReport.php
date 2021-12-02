<?php

namespace App\Http\Livewire\Reports;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\Models\Station;
use App\Models\Parameter;
use App\Models\ClimateObservedData;
use App\Models\DisasterData;
use App\Models\DisasterType;
use App\Models\DisasterImpact;
use App\Models\Greenhousegas;
use App\Models\Statistic;
use App\Models\Sector;
use Carbon\Carbon;


use Livewire\Component;
use Maatwebsite\Excel\Concerns\ToArray;

class LandingReport extends Component
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
    | AJAX Fetch Chart data for Min Max Temperature
    |--------------------------------------------------------------------------
    */
    public function fetchMinMaxTempData(Request $request)
    { 
      //$start_yr = $request->input('start_year');
      //$end_yr = $request->input('end_year');
      $parameter = 3;//$request->input('parameter');
      $station = 2;//$request->input('station');
      $parameter2 = 2;
      $dataset_min = [];
      $dataset_max = [];

      $mintemp = ClimateObservedData::select('id','date_of_reading', 'data')
                    //->where('station_id',$station)
                    ->where('parameter_id',$parameter)
                    
                    ->orderBy('date_of_reading')
                    ->get()
                    ->groupBy(function($item){
                        return (Carbon::parse($item->date_of_reading)->format('M'));
                        });
      $maxtemp = ClimateObservedData::select('id','date_of_reading', 'data')
                    //->where('station_id',$station)
                    ->where('parameter_id',$parameter2)
                    
                    ->orderBy('date_of_reading')
                    ->get()
                    ->groupBy(function($item){
                        return (Carbon::parse($item->date_of_reading)->format('M'));
                        });
      //dd($water_line_data);
      //Prepare for Line Graph
      foreach($mintemp as $index => $dataitem){
        //$monthlist[]=$index;
        $dataset_min[] = (float)$this->findAvgData($dataitem);
        
      }
      foreach($maxtemp as $index => $dataitem){
        //$monthlist[]=$index;
        $dataset_max[] = (float)$this->findAvgData($dataitem);
        
      }
      

      $data[] = array(
        "name" => 'Minimum Temperature',
        "data" => $dataset_min
    );
    
    $data[] = array(
      "name" => 'Maximum Temperature',
      "data" => $dataset_max
  );
    //dd($data);
      return Response:: json($data);
    }

    public function fetchOverallTempData(Request $request)
    { 
      //$start_yr = $request->input('start_year');
      //$end_yr = $request->input('end_year');
      $parameter = 3;//$request->input('parameter');
      $station = 2;//$request->input('station');
      $parameter2 = 2;
      $dataset_min = [];
      $dataset_max = [];

      $mintemp = ClimateObservedData::select('id','date_of_reading', 'data')
                    //->where('station_id',$station)
                    ->where('parameter_id',$parameter)
                    
                    ->orderBy('date_of_reading')
                    ->get()
                    ->groupBy(function($item){
                        return (Carbon::parse($item->date_of_reading)->format('M'));
                        });
      $maxtemp = ClimateObservedData::select('id','date_of_reading', 'data')
                    //->where('station_id',$station)
                    ->where('parameter_id',$parameter2)
                    
                    ->orderBy('date_of_reading')
                    ->get()
                    ->groupBy(function($item){
                        return (Carbon::parse($item->date_of_reading)->format('M'));
                        });
      //dd($water_line_data);
      //Prepare for Line Graph
      foreach($mintemp as $index => $dataitem){
        $monthlist[]=$index;
        $dataset_min[] = (float)$this->findMin($dataitem);
        
      }
      foreach($maxtemp as $index => $dataitem){
        //$monthlist[]=$index;
        $dataset_max[] = (float)$this->findMax($dataitem);
        
      }

      for($i=0; $i < Count($dataset_max);$i++)
      {
        $minmax[]=[$monthlist[$i],$dataset_min[$i],$dataset_max[$i]];
        $mean [] = [$monthlist[$i],($dataset_min[$i]+$dataset_max[$i])/2];
      }
      

      $data[] = $minmax;
    
    $data[] = $mean;
    //dd($data);
      return Response:: json($data);
    }

    /*--------------------------------------------------------------------------
    | AJAX Fetch Chart data for Min Max Temperature
    |--------------------------------------------------------------------------
    */
    public function fetchPrepData(Request $request)
    { 
      $parameter = 1;
      $station = 2;
      $dataset_min = [];
      $dataset_max = [];

      $prep = ClimateObservedData::select('id','date_of_reading', 'data')
                    ->where('station_id',$station)->where('parameter_id',$parameter)
                    
                    ->orderBy('date_of_reading')
                    ->get()
                    ->groupBy(function($item){
                        return (Carbon::parse($item->date_of_reading)->format('M'));
                        });
      
      foreach($prep as $index => $dataitem){
        //$monthlist[]=$index;
        $dataset_min[] = (float)$this->findAvgData($dataitem);
        
      }
      
      $data[] = array(
        "name" => 'Precipitation',
        "data" => $dataset_min
    );
    
    
    //dd($data);
      return Response:: json($data);
    }

    /*--------------------------------------------------------------------------
    | AJAX Fetch Chart data for Disaster - Households Affected
    |--------------------------------------------------------------------------
    */
    public function fetchDisasterData(Request $request)
    { 
      // $parameter = 1;
      // $dzongkhag = 1;
      // $dataset_min = [];
      // $dataset_max = [];
      // $data = [];

      // $disaster = DisasterData::leftJoin('disaster_impacts', 'disaster_data.id', '=', 'Disaster_impacts.disaster_id')
      //               ->where('disaster_impacts.parameter_id',$parameter)
      //               ->get()
      //               ->groupBy('type_id');
      // //dd($disaster->ToArray());$disaster = DisasterData::whereYear('disaster_date',)
      // foreach($disaster as $index => $dataitem){
      //   $disastertype[]=DisasterType::find($index)->name;
      //   $sum = 0;
      //   foreach($dataitem as $dt){
      //     $sum += (float)$dt['value'];
      //   }
      //   $disasterdata[] = $sum;//(float)$this->findAvgData($dataitem); 
      // }

      // //dd($disasterdata);
      // for($i = 0; $i < count($disastertype); $i++){
      //   $data[] = array(
      //     "name" => $disastertype[$i],
      //     "y" => $disasterdata[$i]
      //   );
      // }
      
      $disaster = [];
      $data = [];
      //$disaster_id = 1;
      //$disaster_name = DisasterType::where('id', $disaster_id)
                       // ->first()->name;
      $disasterType = DisasterType::select('id','name')->get();
      $date = DisasterData::select('disaster_date')
          ->orderBy('disaster_date','desc')
          ->first();
      //dd($date['disaster_date']);
      $year = Carbon::parse($date['disaster_date'])->format('Y');
      //dd($year);
      $tdata = DisasterData::whereYear('disaster_date', '=', $year)
          //->where('type_id', '=', $this->disasterId)
          ->get(['disaster_date','type_id'])
          ->groupBy('type_id');

      foreach($tdata as $items){
        //$data[][0] = $station->short_name;
        $count = $items->count();
        foreach($items as $item){
          $name = DisasterType::find($item->type_id)->name;
        }

        //$data[] = [$name, $count];
        $data[] = array(
               "name" => $name,
               "y" => $count
             );
      }
      //$disaster = $data;
    
    //dd($data);
      return Response:: json($data);
    }

    /*--------------------------------------------------------------------------
    | AJAX Fetch Chart data for Greenhouse Gas
    |--------------------------------------------------------------------------
    */
    public function fetchGhgData(Request $request)
    {
      //$yearstart = $request->input('start_year');
      //$yearend = $request->input('end_year');
      
      $ghgdata = Greenhousegas::select('year','sector_id','data')
                //->where('year','>=',$yearstart)
                //->where('year','<=',$yearend)
                ->orderBy('sector_id')
                ->get()
                ->groupBy('sector_id');
//dd($ghgdata->ToArray());
        //seperate into respective arrays required for chart display        
      foreach($ghgdata as $index => $dataitem){
        $sectorlist[]=Sector::find($index)->name;
        //foreach($dataitem as $item){
            //$sectorlist[]= Sector::find($item->sector_id)->name;
            $dataset[]= (float)$this->findAvgData($dataitem);
        //}
      }
      
      //chart dataset 
      foreach($sectorlist as $index => $sector){        
        $data[] = array(
            "name" => $sectorlist[$index],
            "data" => [$dataset[$index]]
        );
    }
        
    return Response:: json($data);
    }

    /** Find Average of Array */
    public function findAvgData($arr){
      $len = count($arr);
      $sum = 0;
      
      foreach($arr as $item)
      {
        $sum += (float)$item['data'];

      }
//dd($sum . ' / ' . $len);
      return $sum/$len;
    }

    /*  Find Maximum from the given array  */
    public function findMax($arr){
      //$len = count($arr);
      $max = 0;
      
      foreach($arr as $item)
      {
        if ($max < (float)$item['data'])
        {
          $max = $item['data'];
        }

      }
      return $max;
    }

    /*  Find Minimum from the given array  */
    public function findMin($arr){
      //$len = count($arr);
      $min = 1000000000;
      
      foreach($arr as $item)
      {
        if ($min > (float)$item['data']){
          $min = $item['data'];
        }

      }
      return $min;
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
