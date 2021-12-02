<?php

namespace App\Http\Livewire\Agency;
use Illuminate\Http\Request;

use Livewire\Component;
use App\Models\Station;
use App\Models\ClimateObservedData;
use App\Models\Parameter;
use Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClimateObservedDataImport;


class ClimateObservedDatas extends Component
{
    public $data;

    public $selectedDatas = [];

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
    public $confirmItemSearch = false;
    public $order = 'asc';

    public $fromDate = 1000; //ensure all years included
    public $toDate = 3000;

    //public []$datalist;
   // public $stationlist;
    //public $parameterlist;
    
    protected $rules = [
        'data.station_id' => 'required',
        'data.parameter_id' => 'required', 
        'data.date_of_reading' => 'required',
        'data.data' => 'required',
    ];

    public function mount()
    {
        $this->selectedDatas = collect();
    }
    public function boot()
    {
        //$this->stationlist = Station::where('station_type_id',2)->get();   
        //$this->parameterlist = Parameter::where('station_type_id',2)->get();
    }
    
    public function render()
    {
        //dd('I am in render');
        $datalist = ClimateObservedData::whereYear('date_of_reading', '>', $this->fromDate)
                    ->whereYear('date_of_reading', '<', $this->toDate)
                    ->orderBy('date_of_reading', $this->order)
                    ->paginate(15);
        $stationlist = Station::where('station_type_id',2)->get();
        $parameterlist = Parameter::where('station_type_id',2)->get();
        return view('backend.livewire.agency.climate-data.climate-observed-datas', compact('datalist','stationlist','parameterlist'));
    }
    /**
     * store post
     *
     * @return void
     */
    public function store()
    {
      $this->validate();
        if(isset($this->data->id)){
          $this->data->save();
          session()->flash('message', 'Data successfully updated!');
      }else{
          ClimateObservedData::create([
          'station_id' =>   $this->data['station_id'], 
          'parameter_id' =>   $this->data['parameter_id'],
          'data' =>   $this->data['data'],
          'date_of_reading' =>   $this->myDateFormat($this->data['date_of_reading']),
          'user_id' => Auth::user()->id,
          ]);
          session()->flash('message', 'Data successfully created!');
        }
        $this->reset(['data']);
        $this->confirmItemAdd = false;
        $this->data = null;
        return back();
    }
     /**
     * store post
     *
     * @return void
     */
    public function climateExcelImport(Request $request)
    {
      $file = $request->file('climatedatafile');
      $stationId = $request->station;
      $parameterId = $request->parameter;
      Excel::import(new ClimateObservedDataImport($stationId,$parameterId),$file);
      session()->flash('message', 'Excel data successfully imported!');
      return back();
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(ClimateObservedData $data)
    {
        $this->data = $data;
        $this->confirmItemAdd = true;
    }

    /**
     * Display confim post deletion modal.
     */

    public function showDeleteModal($id)
    {
        $this->confirmItemDeletion = $id;
    }
     
     /**
      * Delete post item
      *
      * @param  mixed $id
      * @return void
      */
     public function destroy(ClimateObservedData $data)
    {
        $data->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Data deleted successfully.');
        $this->data = null;
        return back();
    }

    public function sortData()
    {
        if($this->order == "desc")
            $this->order = "asc";
        else if($this->order == "asc")
            $this->order = "desc";
        //$this->render();
        return back();
    }

      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['data']);
    }

    /* function to search by date  */

    public function searchByDate()
    {
        $this->confirmItemSearch = false;
    }

    public function deleteSelected()
    {
        ClimateObservedData::query()
                ->whereIn( 'id', $this->selectedDatas)
                ->delete();
        $this->selectedDatas = [];
    }
  
}
