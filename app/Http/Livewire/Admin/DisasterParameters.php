<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\DisasterParameter;
use Auth;

class DisasterParameters extends Component
{
    public $parameter;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'parameter.name' => 'required', 
        'parameter.details' => 'nullable',
    ];
    public function render()
    {
        $parameterlist = DisasterParameter::all();
        return view('backend.livewire.admin.disaster-parameter.index', compact('parameterlist'));
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
            DisasterParameter::create([
            'name' =>   $this->parameter['name'], 
            'details' => $this->parameter['details'],
            'user_id' => Auth::user()->id,
            ]);
            session()->flash('message', 'Parameter successfully created!');
         }
        
        $this->reset(['parameter']);
        $this->confirmItemAdd = false;
        $this->parameter = null;
        $this->resetErrorBag(['parameter']);
        return redirect()->route('admin.disaster.parameters');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(DisasterParameter $parameter)
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
     public function destroy(DisasterParameter $parameter)
    {
        $parameter->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Parameter deleted successfully.');
        $this->parameter = null;
        return redirect()->route('admin.disaster.parameters');
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
