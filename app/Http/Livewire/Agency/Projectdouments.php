<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Projectdocument;
use Illuminate\Support\Facades\Storage;

class Projectdouments extends Component
{
    use withPagination;
    use WithFileUploads;

    public $projectdocument;
    public $document;
    public $filename;
    public $projID;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'projectdocument.title' => 'required', 
    ];


    public function mount($projID)
    {
      $this->projID = $projID;
    }
     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $projectdocuments = Projectdocument::orderBy('created_at','desc')->where('project_id','=',$this->projID)->get();
      return view('livewire.agency.projectdouments',compact('projectdocuments'));
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
        $this->filename = $this->document->storeAs('projectdocuments', time().'.'.$this->document->extension(),'uploads');
        }else{
            $this->filename = null;
        }
      
        Projectdocument::create([
        'title' =>   $this->projectdocument['title'], 
        'document' =>   $this->filename, 
        'project_id' => $this->projID,
        ]);
        session()->flash('message', 'Document successfully created!');
      $this->resetErrorBag(['projectdocument']);
      $this->projectdocument = null;
      $this->confirmItemAdd = false;
      return redirect()->back();
    }

  
     /**
      * Delete post item
      *
      * @param  mixed $id
      * @return void
      */
    public function destroy(Projectdocument $document)
    {
      $document->delete();
      Storage::disk('uploads')->delete($document->document);
      return redirect()->back();
    }
}
