<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Statistic;

class Statistics extends Component
{
    public $statistic;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
      'statistic.name' => 'required', 
      'statistic.type' => 'required', 
    ];

     /**
     * The livewire render function
     * @return void
     */
    public function render()
    {
      $statistics = Statistic::all();
      return view('backend.livewire.admin.statistics.index', 
             compact('statistics'));
    }

    /**
     * store statistic
     * @return void
     */
    public function store()
    {
      $this->validate();
      if(isset($this->statistic->id)){
        $this->statistic->save();
        session()->flash('message', 'Statistic successfully updated!');
      }else{
      Statistic::create([
        'name' =>   $this->statistic['name'], 
        'type' =>   $this->statistic['type'], 
        ]);
        session()->flash('message', 'Statistic successfully created!');
        }
      $this->resetErrorBag(['statistic']);
      $this->statistic = null;
      $this->confirmItemAdd = false;
      return redirect()->route('admin.statistics');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Statistic $statistic)
    {
      $this->statistic = $statistic;
      $this->confirmItemAdd = true;
    }

    /**
     * Display confim statistic deletion modal.
     */
    public function showDeleteModal($id)
    {
      $this->confirmItemDeletion = $id;
    }

     /**
      * Delete statistic item
      * @param  mixed $id
      * @return void
      */
    public function destroy(Statistic $statistic)
    {
      $statistic->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Statistic deleted successfully.');
      $this->statistic = null;
      return redirect()->route('admin.statistics');
    }

      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['statistic']);
    }
}
