<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\DisasterImpact;
use App\Models\DisasterParameter;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DisasterImpactDataImport;

class DisasterImpacts extends Component
{
    public $data;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
    public $disaster_id;

    protected $rules = [
        'data.parameter_id' => 'required', 
        'data.value' => 'required', 
        'data.description' => 'nullable', 
    ];

    /**
     * The livewire render function
     *
     * @return void
     */
    public function mount($disaster)
    {
      $this->disaster_id = $disaster;
    }

    /**
     * Render
     */
    public function render()
    {
        $parameterlist = DisasterParameter::all();
        $datalist = DisasterImpact::where('disaster_id',$this->disaster_id)->paginate(15);
        return view('backend.livewire.agency.disaster-data.disaster-impact-datas',compact('parameterlist','datalist'));
    }

    /**
     * store post
     * @return void
     */

    public function store()
    {
        $this->validate();
         if(isset($this->data->id)){
            $this->data->save();
            session()->flash('message', 'Disaster Impact Data successfully updated!');
        }else{
            DisasterImpact::create([
            'disaster_id' =>   $this->disaster_id, 
            'parameter_id' =>   $this->data['parameter_id'], 
            'value' =>   $this->data['value'], 
            'description' =>   $this->data['description'], 
            'user_id' => Auth::user()->id,
            ]);
            session()->flash('message', 'Disaster Impact Data successfully created!');
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
    public function showEditModal(DisasterImpact $data)
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
     public function destroy(DisasterImpact $data)
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


     public function disasterImpactExcelImport(Request $request)
    {
      $file = $request->file('datafile');
      Excel::import(new DisasterImpactDataImport,$file);
      session()->flash('message', 'Excel data successfully imported!');
      return back();
    }
}
