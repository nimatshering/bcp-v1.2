<?php
namespace App\Http\Livewire\Agency;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\WaterObservedData;
use App\Models\Station;
use App\Models\Parameter;
use Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WaterObservedDataImport;

class WaterObservedDatas extends Component
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
        'data.date_of_reading' => 'required',
        'data.data' => 'required',
    ];

    public function mount()
    {
        $this->selectedDatas = collect();
    }

    public function render()
    {
        $stationlist = Station::where('station_type_id',1)->get();
        $datalist = WaterObservedData::whereYear('date_of_reading', '>', $this->fromDate)
                    ->whereYear('date_of_reading', '<', $this->toDate)
                    ->orderBy('date_of_reading', $this->order)
                    ->paginate(15);
        $parameterlist = Parameter::where('station_type_id',1)->get();
        return view('backend.livewire.agency.water-data.water-observed-datas', compact('stationlist','datalist','parameterlist'));
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
          WaterObservedData::create([
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

    public function waterExcelImport(Request $request)
    {
      $file = $request->file('waterdatafile');
      $stationId = $request->station;
      $parameterId = $request->parameter;
      Excel::import(new WaterObservedDataImport($stationId,$parameterId),$file);
      session()->flash('message', 'Excel data successfully imported!');
      return back();
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(WaterObservedData $data)
    {
        $this->data = $data;
        $this->confirmItemAdd = true;
    }

    /**
     * Display confim post deletion modal.
     */

    public function showDeleteModal($id){
        $this->confirmItemDeletion = $id;
    }
     
     /**
      * Delete post item
      *
      * @param  mixed $id
      * @return void
      */
    public function destroy(WaterObservedData $data)
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
        WaterObservedData::query()
                ->whereIn( 'id', $this->selectedDatas)
                ->delete();
        $this->selectedDatas = [];
    }

}
