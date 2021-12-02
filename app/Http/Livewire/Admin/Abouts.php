<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\About;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Abouts extends Component
{
    use withPagination;
    use WithFileUploads;

    public $about;
    public $photo;
    public $filename;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'about.title' => 'required', 
        'about.content' => 'required', 
    ];


     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $abouts = About::all();
      return view('backend.livewire.admin.abouts.index', compact('abouts'));
    }

    /**
     * store post
     *
     * @return void
     */

     public function store()
    {
      $this->validate();
      if(isset($this->about->id)){
        if(!empty($this->photo)){
          $this->validate(['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048' ]);
          if (Storage::disk('uploads')->exists($this->about->photo)) {
              Storage::disk('uploads')->delete($this->about->photo);
          }
          $this->about->photo = $this->photo->store('abouts','uploads');
        }
        $this->about->slug= Str::slug($this->about->title, '-');
        $this->about->save();
        session()->flash('message', 'About successfully updated!');
      }else{
        if(!empty($this->photo)){
        $this->validate(['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048' ]);
        $this->filename = $this->photo->store('abouts', 'uploads');
        }
      About::create([
      'title' =>   $this->about['title'], 
      'slug' =>    Str::slug($this->about['title'], '-'), 
      'content' => $this->about['content'],
      'photo' => $this->filename,
      ]);
      session()->flash('message', 'about successfully created!');
      }
      $this->resetErrorBag(['about']);
      $this->confirmItemAdd = false;
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(About $about)
    {
        $this->about = $about;
        $this->confirmItemAdd = true;
    }

      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['about']);
    }
}
