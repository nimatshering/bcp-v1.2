<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Staticcontent;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Staticcontents extends Component
{
    use withPagination;
    use WithFileUploads;

    public $staticcontent;
    public $photo;
    public $filename;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'staticcontent.title' => 'required', 
        'staticcontent.content' => 'required', 
    ];


     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $staticcontents = Staticcontent::all();
      return view('backend.livewire.admin.staticcontents.index', compact('staticcontents'));
    }

    /**
     * store post
     *
     * @return void
     */

     public function store()
    {
      $this->validate();
      if(isset($this->staticcontent->id)){
        if(!empty($this->photo)){
          $this->validate(['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048' ]);
          if (Storage::disk('uploads')->exists($this->staticcontent->photo)) {
              Storage::disk('uploads')->delete($this->staticcontent->photo);
          }
          $this->staticcontent->photo = $this->photo->store('staticcontents','uploads');
        }
        $this->staticcontent->slug= Str::slug($this->staticcontent->title, '-');
        $this->staticcontent->save();
        session()->flash('message', 'staticcontent successfully updated!');
      }else{
        if(!empty($this->photo)){
        $this->validate(['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048' ]);
        $this->filename = $this->photo->store('staticcontents', 'uploads');
        }
      Staticcontent::create([
      'title' =>   $this->staticcontent['title'], 
      'slug' =>    Str::slug($this->staticcontent['title'], '-'), 
      'content' => $this->staticcontent['content'],
      'photo' => $this->filename,
      ]);
      session()->flash('message', 'staticcontent successfully created!');
      }
      $this->resetErrorBag(['staticcontent']);
      $this->confirmItemAdd = false;
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Staticcontent $staticcontent)
    {
        $this->staticcontent = $staticcontent;
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
     public function destroy(Staticcontent $staticcontent)
    {
        $staticcontent->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Static content deleted successfully.');
        $this->sector = null;
        return redirect()->back();
    }

      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['staticcontent']);
    }
}
