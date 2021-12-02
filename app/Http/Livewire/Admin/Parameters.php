<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Parameter;
use App\Models\StationType;

use Livewire\WithPagination;
use Livewire\WithFileUploads;
use SebastianBergmann\Type\StaticType;

class Parameters extends Component
{
    public $parameter;
    //public $scenario_id;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'parameter.name' => 'required', 
        'parameter.unit' => 'required',
        'parameter.station_type_id' => 'required',
    ];



     /**
     * The livewire render function
     * @return void
     */
    /*public function mount($scenario)
    {
        $this->scenario_id = $scenario;
    }*/


    public function render()
    {
        $parameters = Parameter::all();
        $typelist = StationType::all();
        return view('backend.livewire.admin.parameters.index', compact('parameters','typelist'));
    }

    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        $this->validate();
         if(isset($this->parameter->id)){
            $this->parameter->save();
            session()->flash('message', 'Parameter successfully updated!');

        }else{
            Parameter::create([
            //'scenario_id' =>  $this->scenario_id, 
            'name' =>   $this->parameter['name'], 
            'unit' =>   $this->parameter['unit'], 
            'station_type_id' =>   $this->parameter['station_type_id'], 
            ]);
            session()->flash('message', 'Parameter successfully created!');
         }
        
        $this->reset(['parameter']);
        $this->confirmItemAdd = false;
        $this->parameter = null;
        $this->resetErrorBag(['parameter']);
        return redirect()->route('admin.parameters');//,$this->scenario_id);
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Parameter $parameter)
    {
        $this->parameter = $parameter;
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
     public function destroy(Parameter $parameter)
    {
        $parameter->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Parameter deleted successfully.');
        $this->parameter = null;
        return redirect()->route('admin.parameters');//,$this->scenario_id);
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['parameter']);
    }
}
