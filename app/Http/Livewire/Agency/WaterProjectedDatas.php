<?php

namespace App\Http\Livewire\Agency;
use Illuminate\Http\Request;

use Livewire\Component;
use App\Models\Station;
use App\Models\Parameter;
use App\Models\ClimateModel;
use App\Models\ClimateScenerio;
use App\Models\WaterProjectedData;
use Carbon\Carbon;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WaterProjectedDataImport;

class WaterProjectedDatas extends Component
{
    public $data;

    public $selectedDatas = [];
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
    public $confirmItemSearch = false;
    public $order = 'asc';

    public $fromDate = 1000; //ensure all years included
    public $toDate = 3000;

    protected $rules = [
        'data.station_id' => 'required',
        'data.parameter_id' => 'required', 
        'data.model_id' => 'required', 
        'data.scenerio_id' => 'required', 
        'data.date_of_reading' => 'required',
        'data.data' => 'required',
        'data.data_source' => 'nullable',

    ];

    public function mount()
    {
        $this->selectedDatas = collect();
    }

    public function render()
    {
        $datalist = WaterProjectedData::whereYear('date_of_reading', '>', $this->fromDate)
                    ->whereYear('date_of_reading', '<', $this->toDate)
                    ->orderBy('date_of_reading', $this->order)
                    ->paginate(15);
        $stationlist = Station::where('station_type_id',1)->get();
        $parameterlist = Parameter::where('station_type_id',1)->get();
        $modellist = ClimateModel::all();
        $sceneriolist = ClimateScenerio::all();
        return view('backend.livewire.agency.water-data.water-projected-datas', compact('datalist','stationlist','parameterlist','modellist','sceneriolist'));
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
          WaterProjectedData::create([
          'station_id' =>   $this->data['station_id'], 
          'parameter_id' =>   $this->data['parameter_id'],
          'model_id' =>   $this->data['model_id'],
          'scenerio_id' =>   $this->data['scenerio_id'],
          'data' =>   $this->data['data'],
          'data_source' =>   $this->data['data_source'],
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
    public function WaterProjectedImport(Request $request)
    {
      $file = $request->file('waterdatafile');
      $stationId = $request->station;
      $parameterId = $request->parameter;
      $modelId = $request->model;
      $scenerioId = $request->scenerio;
      Excel::import(new WaterProjectedDataImport($stationId,$parameterId,$modelId,$scenerioId),$file);
      session()->flash('message', 'Excel data successfully imported!');
      return back();
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(WaterProjectedData $data)
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
     public function destroy(WaterProjectedData $data)
    {
        $data->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Data deleted successfully.');
        $this->data = null;
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


     /**
     * Import excel Data
     */
    
    public function sortData()
    {
        if($this->order == "desc")
            $this->order = "asc";
        else if($this->order == "asc")
            $this->order = "desc";
        //$this->render();
        return back();
    }

    /* function to search by date  */

    public function searchByDate()
    {
        $this->confirmItemSearch = false;
    }

    public function deleteSelected()
    {
        WaterProjectedData::query()
                ->whereIn( 'id', $this->selectedDatas)
                ->delete();
        $this->selectedDatas = [];
    }
}
