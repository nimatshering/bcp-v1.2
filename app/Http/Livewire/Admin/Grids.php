<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Grid;

class Grids extends Component
{
    public $grid;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'grid.grid_no' => 'required',
        'grid.north_latitude' => 'required', 
        'grid.north_longitude' => 'required',
        'grid.south_latitude' => 'required',
        'grid.south_longitude' => 'required',
        'grid.east_latitude' => 'required',
        'grid.east_longitude' => 'required',
        'grid.west_latitude' => 'required',
        'grid.west_longitude' => 'required',
    ];
    public function render()
    {
        $gridlist = Grid::all();
        return view('backend.livewire.admin.grids.grids', compact('gridlist'));
    }

    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        //dd($this->grid);
        $this->validate();
        //dd($this->grid);
         if(isset($this->grid->id)){
            $this->grid->save();
            session()->flash('message', 'grid successfully updated!');

        }else{
            Grid::create([
            'grid_no' =>   $this->grid['grid_no'], 
            'north_latitude' =>   $this->grid['north_latitude'],
            'north_longitude' =>   $this->grid['north_longitude'],
            'south_latitude' =>   $this->grid['south_latitude'],
            'south_longitude' =>   $this->grid['south_longitude'],
            'east_latitude' =>   $this->grid['east_latitude'],
            'east_longitude' =>   $this->grid['east_longitude'],
            'west_latitude' =>   $this->grid['west_latitude'],
            'west_longitude' =>   $this->grid['west_longitude'],
            
            ]);
            session()->flash('message', 'Grid successfully created!');
         }
        
        $this->reset(['grid']);
        $this->confirmItemAdd = false;
        $this->grid = null;
        $this->resetErrorBag(['grid']);
        return redirect()->route('admin.grids');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Grid $grid)
    {
        $this->grid = $grid;
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
     public function destroy(Grid $grid)
    {
        $grid->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Grid deleted successfully.');
        $this->grid = null;
        return redirect()->route('admin.grids');
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['grid']);
    }
}
