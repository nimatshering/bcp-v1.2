<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\DisasterType;
use Auth;

class DisasterTypes extends Component
{
    public $disastertype;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'disastertype.name' => 'required', 
        'disastertype.details' => 'nullable',
    ];

    public function render()
    {
        $typelist = DisasterType::all();
        return view('backend.livewire.admin.disaster-type.index', compact('typelist'));
    }

    /**
     * store post
     *
     * @return void
     */
    public function store()
    {
        $this->validate();
         if(isset($this->disastertype->id)){
            $this->disastertype->save();
            session()->flash('message', 'Type successfully updated!');

        }else{
            DisasterType::create([
            'name' =>   $this->disastertype['name'], 
            'details' => $this->disastertype['details'],
            'user_id' => Auth::user()->id,
            ]);
            session()->flash('message', 'Type successfully created!');
         }
        
        $this->reset(['disastertype']);
        $this->confirmItemAdd = false;
        $this->type = null;
        $this->resetErrorBag(['disastertype']);
        return redirect()->route('admin.disaster.types');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(DisasterType $disastertype)
    {
        $this->disastertype = $disastertype;
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
     public function destroy(DisasterType $type)
    {
        $type->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Type deleted successfully.');
        $this->type = null;
        return redirect()->route('admin.disaster.types');
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['disastertype']);
    }
}
