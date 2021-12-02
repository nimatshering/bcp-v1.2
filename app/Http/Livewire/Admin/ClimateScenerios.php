<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ClimateScenerio;

class ClimateScenerios extends Component
{
    public $climatescenerio;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'climatescenerio.name' => 'required', 
        'climatescenerio.remarks' => 'nullable',
    ];
    public function render()
    {
        $sceneriolist = ClimateScenerio::all();
        return view('backend.livewire.admin.climate-scenerios', compact('sceneriolist'));
    }

    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        $this->validate();

         if(isset($this->climatescenerio->id)){
            $this->climatescenerio->save();
            session()->flash('message', 'Scenerio successfully updated!');

        }else{
            ClimateScenerio::create([
            'name' =>   $this->climatescenerio['name'], 
            'remarks' =>   $this->climatescenerio['remarks'], 
            
            ]);
            session()->flash('message', 'Scenerio successfully created!');
         }
        
        $this->reset(['climatescenerio']);
        $this->confirmItemAdd = false;
        $this->climatemodel = null;
        $this->resetErrorBag(['climatescenerio']);
        return redirect()->route('admin.climate-scenerios');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(ClimateScenerio $climatescenerio)
    {
        $this->climatescenerio = $climatescenerio;
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
     public function destroy(ClimateScenerio $climatescenerio)
    {
        $climatescenerio->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Scenerio deleted successfully.');
        $this->climatescenerio = null;
        return redirect()->route('admin.climate-scenerios');
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['climatescenerio']);
    }

}