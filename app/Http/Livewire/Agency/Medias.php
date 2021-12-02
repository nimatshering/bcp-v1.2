<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Medias extends Component
{
     use withPagination;
    use WithFileUploads;

    public $media;
    public $photo;
    public $filename;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
      'media.title' => 'required', 
      'media.videolink' => 'required', 
    ];

     /**
     * The livewire render function
     * @return void
     */
    public function render()
    {
      $medias = Media::orderBy('created_at','desc')->paginate(10);
      return view('backend.livewire.agency.media.index', compact('medias'));
    }

    /**
     * store media
     * @return void
     */
    public function store()
    {
      $this->validate();
      if(isset($this->media->id)){
        $this->media->save();
        session()->flash('message', 'Media successfully updated!');
      }else{
        media::create([
        'title' =>   $this->media['title'], 
        'videolink' => $this->media['videolink'],
        ]);
        session()->flash('message', 'Media added successfully created!');
        }
        $this->resetErrorBag(['media']);
        $this->confirmItemAdd = false;
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Media $media)
    {
      $this->media = $media;
      $this->confirmItemAdd = true;
    }

    /**
     * Display confim media deletion modal.
     */

    public function showDeleteModal($id)
    {
      $this->confirmItemDeletion = $id;
    }

     /**
      * Delete media item
      *
      * @param  mixed $id
      * @return void
      */
    public function destroy(Media $media)
    {
      $media->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'media deleted successfully.');
      return redirect()->route('agency.medias');
    }

      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['media']);
    }
}
