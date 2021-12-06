<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use App\Models\Csrdocument;
use App\Models\Csrsubcategory;

use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Climatescienceresearchs extends Component
{
    use withPagination;
    use WithFileUploads;

    public $publication;
    public $document;
    public $filename;
    public $catID;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'publication.title' => 'required', 
        'publication.author' => 'required', 
        'publication.agency' => 'required', 
        'publication.description' => 'required', 
        'publication.subcategory_id' => 'required', 
        'publication.published_at' => 'required', 
        'publication.document' => 'nullable', 
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
      $subcategories = Csrsubcategory::where('cat_id',$this->catID)->get();
      // dd($subcategories);
      return view('backend.livewire.agency.climate-science-research.index', compact('subcategories'));
    }


    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        $this->validate();
        if(isset($this->publication->id)){
            if(!empty($this->document)){
                $this->validate(['document' => 'file|mimes:peg,png,jpg,pdf,doc,docx,xls,xlsx|max:50000']);
                if (Storage::disk('uploads')->exists($this->publication->document)) {
                        Storage::disk('uploads')->delete($this->publication->document);
                }
                $this->publication->document = $this->document->storeAs('publications', time().'.'.$this->document->extension(),'uploads');
            }
            $this->publication->slug= Str::slug($this->publication->title, '-');
            $this->publication->save();
            session()->flash('message', 'Record updated successfully!');

        }else{
                if(!empty($this->document)){
                $this->validate(['document' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx|max:50000' ]);
                $this->filename = $this->document->storeAs('publications', time().'.'.$this->document->extension(),'uploads');
                }else{
                    $this->filename = null;
                }

          Csrdocument::create([
            'title' =>   $this->publication['title'], 
            'slug' =>    Str::slug($this->publication['title'], '-'),             
            'author' =>   $this->publication['author'], 
            'agency' =>   $this->publication['agency'], 
            'description' =>   $this->publication['description'], 
            'document' =>   $this->filename, 
            'subcategory_id' =>   $this->publication['subcategory_id'], 
            'published_at' =>   $this->publication['published_at'], 
            ]);

            session()->flash('message', 'Record successfully created!');
            }
        $this->resetErrorBag(['publication']);
        $this->publication = null;
        $this->confirmItemAdd = false;
        return redirect()->route('agency.climate.science.research',$this->catID);
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Csrdocument $publication)
    {
        $this->publication = $publication;
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
     public function destroy(Csrdocument $publication)
    {
        $publication->delete();
        Storage::disk('uploads')->delete($publication->document);
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Record deleted successfully.');
        $this->publication = null;
        return redirect()->route('agency.climate.science.research',$this->catID);
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['publication']);
    }
}
