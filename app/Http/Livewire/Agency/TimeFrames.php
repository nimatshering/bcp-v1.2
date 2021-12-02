<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use App\Models\TimeFrame;

class TimeFrames extends Component
{
    public $frame;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'frame.name' => 'required', 
        'frame.description' => 'required',
    ];

    public function render()
    {
        $framelist = TimeFrame::all();
        return view('livewire.time-frames', compact('framelist'));
    }

    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        $this->validate();

         if(isset($this->frame->id)){
            $this->frame->save();
            session()->flash('message', 'Time Frame successfully updated!');

        }else{
            TimeFrame::create([
            'name' =>   $this->frame['name'], 
            'description' => $this->frame['description'],
            
            ]);
            session()->flash('message', 'Time Frame successfully created!');
         }
        
        $this->reset(['frame']);
        $this->confirmItemAdd = false;
        $this->frame = null;
        return back();
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(TimeFrame $frame)
    {
        $this->frame = $frame;
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
     public function destroy(TimeFrame $frame)
    {
        $frame->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Time Frame deleted successfully.');
        $this->frame = null;
        return back();
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['frame']);
    }
}
