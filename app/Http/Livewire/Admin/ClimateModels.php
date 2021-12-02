<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ClimateModel;

class ClimateModels extends Component
{
    public $climatemodel;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'climatemodel.name' => 'required', 
        'climatemodel.remarks' => 'nullable',
    ];

    public function render()
    {
        $modellist = ClimateModel::all();
        return view('backend.livewire.admin.climate-models', compact('modellist'));
    }

     /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        $this->validate();

         if(isset($this->climatemodel->id)){
            $this->climatemodel->save();
            session()->flash('message', 'Model successfully updated!');

        }else{
            ClimateModel::create([
            'name' =>   $this->climatemodel['name'], 
            'remarks' =>   $this->climatemodel['remarks'], 
            
            ]);
            session()->flash('message', 'Model successfully created!');
         }
        
        $this->reset(['climatemodel']);
        $this->confirmItemAdd = false;
        $this->climatemodel = null;
        $this->resetErrorBag(['climatemodel']);
        return redirect()->route('admin.climate-models');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(ClimateModel $climatemodel)
    {
        $this->climatemodel = $climatemodel;
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
     public function destroy(ClimateModel $climatemodel)
    {
        $climatemodel->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Model deleted successfully.');
        $this->climatemodel = null;
        return redirect()->route('admin.climate-models');
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['climatemodel']);
    }
}