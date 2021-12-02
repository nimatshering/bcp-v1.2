<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Researchstudydocument;
use Illuminate\Support\Facades\Storage;

class Researchstudydocuments extends Component
{
    use withPagination;
    use WithFileUploads;

    public $researchstudydocument;
    public $document;
    public $filename;
    public $researchID;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'researchstudydocument.title' => 'required', 
    ];


    public function mount($researchID)
    {
      $this->researchID = $researchID;
    }
     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $researchstudydocuments = Researchstudydocument::orderBy('created_at','desc')->where('research_id','=',$this->researchID)->get();
      return view('livewire.agency.researchstudydocuments',compact('researchstudydocuments'));
    }

    /**
     * store post
     *
     * @return void
     */
    public function store()
    {
      $this->validate();
        if(!empty($this->document)){
        $this->validate(['document' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx|max:50000' ]);
        $this->filename = $this->document->storeAs('researchstudydocuments', time().'.'.$this->document->extension(),'uploads');
        }else{
            $this->filename = null;
        }
      
        Researchstudydocument::create([
        'title' =>   $this->researchstudydocument['title'], 
        'document' =>   $this->filename, 
        'research_id' => $this->researchID,
        ]);
        session()->flash('message', 'Document successfully created!');
      $this->resetErrorBag(['researchstudydocument']);
      $this->researchstudydocument = null;
      $this->confirmItemAdd = false;
      return redirect()->back();
    }

  
     /**
      * Delete post item
      *
      * @param  mixed $id
      * @return void
      */
    public function destroy(Researchstudydocument $researchstudydocument)
    {
      $researchstudydocument->delete();
      Storage::disk('uploads')->delete($researchstudydocument->document);
      return redirect()->back();
    }
}
