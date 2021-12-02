<?php

namespace App\Http\Livewire\Reports;
use Illuminate\Http\Request;

use Livewire\Component;
use App\Models\Dzongkhag;
use App\Models\DisasterType;
use App\Models\DisasterData;

class DisasterReports extends Component
{
  public $disaster;
  public $disastertypes;
  public $genReport = false;
  public $dzongkhags;
  public $disasters;

  protected $rules = [
        'disaster.dzongkhag_id' => 'required', 
        'disaster.type_id' => 'required',
        'disaster.start_yr' => 'required',
        'disaster.end_yr' => 'required',
    ];

    /*--------------------------------------------------------------------------
    |  render
    |--------------------------------------------------------------------------
    */
    public function render()
    {
      $this->dzongkhags = Dzongkhag::all();
      $this->disastertypes = DisasterType::all();
      return view('livewire.reports.disaster-reports');
    }

 
    /*--------------------------------------------------------------------------
    |  Fetch Report data
    |--------------------------------------------------------------------------
    */
    public function submit()
    {
      $this->validate();
      $this->genReport = true;
      $dzID = $this->disaster['dzongkhag_id'];
      $disasterType = $this->disaster['type_id'];
      $yearstart = $this->disaster['start_yr'];
      $yearend = $this->disaster['end_yr'];
      $this->disasters = DisasterData::where('dzongkhag_id',$dzID)
                                      ->where('type_id',$disasterType)
                                      ->whereYear('disaster_date','>=',$yearstart)
                                      ->whereYear('disaster_date','<=',$yearend)
                                      ->get();
    }

    /*-------------------------------------------------------------------------
    |  Research publication download 
    |--------------------------------------------------------------------------
    */
    public function reportDownload($report) {
      $disaster = DisasterData:: where('report_link', $report)->first();
      $file_path = public_path('/uploads/' . $disaster->report_link);
      return response()->download($file_path);
    }
}
