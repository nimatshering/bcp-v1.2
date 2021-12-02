<?php

namespace App\Http\Livewire\Agency;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Grid;
use App\Models\ClimateReanalyzedData;
use App\Models\Parameter;
use Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClimateReanalyzedDataImport;

class ClimateReanalyzedDatas extends Component
{
    public $data;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
    public $selectedDatas = [];
    public $confirmItemSearch = false;
    public $order = 'asc';

    public $fromDate = 1000; //ensure all years included
    public $toDate = 3000;

    protected $rules = [
        'data.station_id' => 'required',
        'data.parameter_id' => 'required', 
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
        $stationlist = Grid::all();
        $datalist = ClimateReanalyzedData::whereYear('date_of_reading', '>', $this->fromDate)
                    ->whereYear('date_of_reading', '<', $this->toDate)
                    ->orderBy('date_of_reading', $this->order)
                    ->paginate(15);//orderBy('date_of_reading','desc')->get();
        $parameterlist = Parameter::where('station_type_id',2)->get();
        return view('backend.livewire.agency.climate-data.climate-reanalyzed-datas', compact('stationlist','datalist','parameterlist'));
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
            ClimateReanalyzedData::create([
            'station_id' =>   $this->data['station_id'], 
            'parameter_id' =>   $this->data['parameter_id'],
            'data' =>   $this->data['data'],
            'data_source' => $this->data['data_source'],
            'date_of_reading' =>   $this->data['date_of_reading'],
            'user_id' => Auth::user()->id,
            ]);
            session()->flash('message', 'Data successfully created!');
         }
        
        $this->reset(['data']);
        $this->confirmItemAdd = false;
        $this->data = null;
        return back();
    }

    public function climateReanalyzedExcelImport(Request $request)
    {
      $file = $request->file('climatedatafile');
      $stationId = $request->station;
      $parameterId = $request->parameter;
      //dd($stationId);
      Excel::import(new ClimateReanalyzedDataImport($stationId,$parameterId),$file);
      session()->flash('message', 'Excel data successfully imported!');
      return back();
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(ClimateReanalyzedData $data)
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
     public function destroy(ClimateReanalyzedData $data)
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

    /**
     * store post
     *
     * @return void
     */
    public function climateExcelImport(Request $request)
    {
      $file = $request->file('climatedatafile');
      Excel::import(new ClimateReanalyzedDataImport,$file);
      session()->flash('message', 'Data successfully updated!');
      return back();
    }

    /** Change required Date Format */
    public function myDateFormat(string $datestr)
    {
        $carbon = new Carbon($datestr);
        return $carbon->format('Y-m-d');
    }

    /* function to search by date  */

    public function searchByDate()
    {
        $this->confirmItemSearch = false;
    }

    public function deleteSelected()
    {
        ClimateReanalyzedData::query()
                ->whereIn( 'id', $this->selectedDatas)
                ->delete();
        $this->selectedDatas = [];
    }
}
