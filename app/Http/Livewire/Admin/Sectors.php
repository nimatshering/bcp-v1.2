<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Sector;

class Sectors extends Component
{
    public $sector;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'sector.name' => 'required', 
    ];
    public function render()
    {
        $sectorlist = Sector::all();
        return view('backend.livewire.admin.sectors.index', compact('sectorlist'));
    }

    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        $this->validate();

         if(isset($this->sector->id)){
            $this->sector->save();
            session()->flash('message', 'Sector successfully updated!');

        }else{
            Sector::create([
            'name' =>   $this->sector['name'], 
            
            ]);
            session()->flash('message', 'Sector successfully created!');
         }
        
        $this->reset(['sector']);
        $this->confirmItemAdd = false;
        $this->sector = null;
        $this->resetErrorBag(['sector']);
        return redirect()->route('admin.sectors');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Sector $sector)
    {
        $this->sector = $sector;
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
     public function destroy(Sector $sector)
    {
        $sector->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Sector deleted successfully.');
        $this->sector = null;
        return redirect()->route('admin.sectors');
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['sector']);
    }
}
