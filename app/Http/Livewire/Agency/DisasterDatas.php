<?php

namespace App\Http\Livewire\Agency;
use Livewire\WithFileUploads;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Dzongkhag;
use App\Models\DisasterType;
use App\Models\DisasterData;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DisasterDataImport;
use Faker\Guesser\Name;

class DisasterDatas extends Component
{
    public $data;
    use WithFileUploads;
    public $report;
    public $filename;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'data.dzongkhag_id' => 'required', 
        'data.type_id' => 'required', 
        'data.disaster_date' => 'required', 
        'data.report_link' => 'nullable', 
        'data.data_source' => 'required', 
        'data.remarks' => 'nullable', 
    ];

    public function render()
    {
        $dzongkhaglist = Dzongkhag::all();
        $typelist = DisasterType::all();
        $datalist = DisasterData::all();
        return view('backend.livewire.agency.disaster-data.disaster-datas',compact('dzongkhaglist','typelist','datalist'));
    }

    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        $this->validate();
        if(!empty($this->report)){
            $this->validate(['report' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx|max:50000' ]);
            $this->filename = $this->report->storeAs('disasters', time().'.'.$this->report->extension(),'uploads');
            }else{
                $this->filename = null;
            }
            
         if(isset($this->data->id)){
            $this->data->save();
            session()->flash('message', 'Disaster Data successfully updated!');
        }else{
            DisasterData::create([
            'dzongkhag_id' =>   $this->data['dzongkhag_id'], 
            'type_id' =>   $this->data['type_id'], 
            'disaster_date' =>   $this->data['disaster_date'], 
            'report_link' =>   $this->filename, 
            'data_source' =>   $this->data['data_source'], 
            'remarks' =>   $this->data['remarks'], 
            'user_id' => Auth::user()->id,
            ]);
            session()->flash('message', 'Disaster Data successfully created!');
         }
        
        $this->reset(['data']);
        $this->confirmItemAdd = false;
        $this->data = null;
        $this->resetErrorBag(['data']);
        return back();
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(DisasterData $data)
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
     public function destroy(DisasterData $data)
    {
        $data->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Disaster Data deleted successfully.');
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
     * store post
     *
     * @return void
     */
    public function disasterExcelImport(Request $request)
    {
      $file = $request->file('datafile');
      $dzongkhagId = $request->dzongkhag;
      $parameterId = $request->parameter;
      Excel::import(new DisasterDataImport($dzongkhagId,$parameterId),$file);
      session()->flash('message', 'Excel data successfully imported!');
      return back();
    }
}
