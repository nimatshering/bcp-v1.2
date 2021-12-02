<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Trainingdocument;
use Illuminate\Support\Facades\Storage;

class Trainingdocuments extends Component
{
    use withPagination;
    use WithFileUploads;

    public $trainingmaterial;
    public $document;
    public $filename;
    public $trainID;


    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'trainingmaterial.title' => 'required', 
    ];


    public function mount($trainID)
    {
      $this->trainID = $trainID;
    }

     /**
     * The livewire render function
     * @return void
     */
    public function render()
    {
      $trainingdocuments = Trainingdocument::orderBy('created_at','desc')->where('training_id','=',$this->trainID)->get();
      return view('livewire.agency.trainingdocuments',compact('trainingdocuments'));
    }


    /**
     * store post
     * @return void
     */

    public function store()
    {
      $this->validate();
        if(!empty($this->document)){
        $this->validate(['document' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx|max:50000' ]);
        $this->filename = $this->document->storeAs('trainingmaterials', time().'.'.$this->document->extension(),'uploads');
        }else{
            $filename = null;
        }
      Trainingdocument::create([
        'title' =>   $this->trainingmaterial['title'], 
        'training_id' =>   $this->trainID, 
        'document' =>    $this->filename, 
        ]);

        session()->flash('message', 'Training material successfully created!');
      $this->resetErrorBag(['material']);
      $this->trainingmaterial = null;
      $this->confirmItemAdd = false;
      return redirect()->back();
    }

    

     /**
      * Delete post item
      * @param  mixed $id
      * @return void
      */
    public function destroy(Trainingdocument $trainingdocument)
    {
      $trainingdocument->delete();
      Storage::disk('uploads')->delete($trainingdocument->document);
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Document deleted successfully.');
      $this->trainingmaterial = null;
      return redirect()->back();
    }
}
