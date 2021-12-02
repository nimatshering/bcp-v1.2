<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Events extends Component
{
    use withPagination;
    use WithFileUploads;

    public $event;
    public $photo;
    public $filename;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
      'event.title' => 'required', 
      'event.description' => 'required', 
      'event.start_at' => 'required', 
      'event.end_at' => 'required', 
    ];

     /**
     * The livewire render function
     * @return void
     */
    public function render()
    {
      $events = Event::orderBy('created_at','desc')->paginate(10);
      return view('backend.livewire.agency.events.index', compact('events'));
    }

    /**
     * store event
     * @return void
     */
    public function store()
    {
      $this->validate();
      if(isset($this->event->id)){
        if(!empty($this->photo)){
          $this->validate(['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' ]);
          if (Storage::disk('uploads')->exists($this->event->photo)) {
              Storage::disk('uploads')->delete($this->event->photo);
          }
          $this->event->photo = $this->photo->storeAs('event', time().'.'.$this->photo->extension(),'uploads');
        }
        $this->event->slug= Str::slug($this->event->title, '-');
        $this->event->save();
        session()->flash('message', 'event successfully updated!');
      }else{
        if(!empty($this->photo)){
        $this->validate(['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' ]);
        $filename = $this->photo->storeAs('events', time().'.'.$this->photo->extension(),'uploads');
        }else{
          $filename = null;
        }
      Event::create([
      'title' =>   $this->event['title'], 
      'slug' =>    Str::slug($this->event['title'], '-'), 
      'description' => $this->event['description'],
      'photo' => $this->filename,
      'start_at' => $this->event['start_at'],
      'end_at' => $this->event['end_at'],
      ]);
      session()->flash('message', 'event successfully created!');
      }
      $this->resetErrorBag(['event']);
      $this->confirmItemAdd = false;
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Event $event)
    {
      $this->event = $event;
      $this->confirmItemAdd = true;
    }

    /**
     * Display confim event deletion modal.
     */

    public function showDeleteModal($id)
    {
      $this->confirmItemDeletion = $id;
    }

     
     /**
      * Delete event item
      *
      * @param  mixed $id
      * @return void
      */
    public function destroy(Event $event)
    {
      $event->delete();
      Storage::disk('uploads')->delete($event->photo);
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Event deleted successfully.');
      $this->photo = null;
      return redirect()->route('agency.events');
    }

      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['event']);
    }
}
