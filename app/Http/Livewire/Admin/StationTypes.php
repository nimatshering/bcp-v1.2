<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\StationType;

class StationTypes extends Component
{
    public $type;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'type.name' => 'required', 
    ];
    public function render()
    {
        $typelist = StationType::all();
        return view('backend.livewire.admin.station-type.index', compact('typelist'));
    }

    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        $this->validate();

         if(isset($this->type->id)){
            $this->type->save();
            session()->flash('message', 'Type successfully updated!');

        }else{
            StationType::create([
            'name' =>   $this->type['name'], 
            
            ]);
            session()->flash('message', 'Type successfully created!');
         }
        
        $this->reset(['type']);
        $this->confirmItemAdd = false;
        $this->type = null;
        $this->resetErrorBag(['type']);
        return redirect()->route('admin.station.types');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(StationType $type)
    {
        $this->type = $type;
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
     public function destroy(StationType $type)
    {
        $type->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Type deleted successfully.');
        $this->type = null;
        return redirect()->route('admin.station.types');
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['type']);
    }
}
