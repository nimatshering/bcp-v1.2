<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Documentcategory;
use App\Models\Guidancedocument;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Guidancedocuments extends Component
{
    use withPagination;
    use WithFileUploads;

    public $guidancedocument;
    public $document;
    public $catID;
    public $filename;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'guidancedocument.title' => 'required', 
        'guidancedocument.author' => 'required', 
        'guidancedocument.description' => 'required', 
        'guidancedocument.published_at' => 'required', 
    ];

    
    public function mount($catID)
    {
      $this->catID = $catID;
    }

     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $guidancedocuments = Guidancedocument::orderBy('created_at','desc')
        ->where('category_id','=',$this->catID)
        ->paginate(10);
      return view('backend.livewire.agency.guidance-documents.index',compact('guidancedocuments'));
    }


    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
      $this->validate();
      if(isset($this->guidancedocument->id)){
        if(!empty($this->document)){
          $this->validate(['document' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx|max:50000']);
          if (Storage::disk('uploads')->exists($this->guidancedocument->document)) {
              Storage::disk('uploads')->delete($this->guidancedocument->document);
          }
          $this->guidancedocument->document = $this->document->storeAs('guidancedocuments', time().'.'.$this->document->extension(),'uploads');
        }
        $this->guidancedocument->slug= Str::slug($this->guidancedocument->title, '-');
        $this->guidancedocument->save();
        session()->flash('message', 'guidancedocument successfully updated!');
      }else{
        if(!empty($this->document)){
        $this->validate(['document' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx|max:50000' ]);
        $filename = $this->document->storeAs('guidancedocuments', time().'.'.$this->document->extension(),'uploads');
        }else{
            $filename = null;
        }
      Guidancedocument::create([
        'title' =>   $this->guidancedocument['title'], 
        'slug' =>    Str::slug($this->guidancedocument['title'], '-'),             
        'author' =>   $this->guidancedocument['author'], 
        'description' =>   $this->guidancedocument['description'], 
        'document' =>   $filename, 
        'category_id' => $this->catID,
        'published_at' =>   $this->guidancedocument['published_at'], 
        ]);

        session()->flash('message', 'Document successfully created!');
        }
      $this->resetErrorBag(['guidancedocument']);
      $this->guidancedocument = null;
      $this->confirmItemAdd = false;
      return redirect()->route('agency.guidance.document',$this->catID);
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Guidancedocument $guidancedocument)
    {
      $this->guidancedocument = $guidancedocument;
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
    public function destroy(Guidancedocument $document)
    {
      $document->delete();
      Storage::disk('uploads')->delete($document->document);
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Document deleted successfully.');
      $this->guidancedocument = null;
      return redirect()->route('agency.guidance.document',$this->catID);
    }

      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['guidancedocument']);
    }
}
