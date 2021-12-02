<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Csrsubcategory;
use Illuminate\Support\Str;

class Csrsubcategories extends Component
{
    public $subcategory;
    public $cat_id;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'subcategory.icon' => 'required',
        'subcategory.name' => 'required',
        'subcategory.slug' => 'nullable',
        'subcategory.definition' => 'required'
    ];


     /**
     * The livewire render function
     *
     * @return void
     */
    public function mount($cat_id)
    {
        $this->cat_id = $cat_id;
    }

     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $subcategories = Csrsubcategory::orderBy('created_at','desc')
				->where('cat_id','=',$this->cat_id)
				->paginate(10);
      return view('backend.livewire.admin.csr-subcategory.index', compact('subcategories'));
    }

    /**
     * store post
     *
     * @return void
     */
     public function store()
    {
        $this->validate();
        if(isset($this->subcategory->id)){
            $this->subcategory->slug = Str::slug($this->subcategory['name'], '-');
            $this->subcategory->save();
            session()->flash('message', 'Climate Science and research subcategory updated successfully !');
        }else{
            Csrsubcategory::create([
            'icon' =>   $this->subcategory['icon'], 
            'cat_id' =>   $this->cat_id, 
            'name' =>   $this->subcategory['name'], 
            'definition' =>   $this->subcategory['definition'], 
            'slug' =>    Str::slug($this->subcategory['name'], '-'), 
            ]);
            session()->flash('message', 'Climate Science and research subcategory successfully created!');
            }
        
        $this->resetErrorBag(['subcategory']);
        $this->confirmItemAdd = false;
        $this->subcategory = null;
        return redirect()->route('admin.climatescience.research.subcategory', $this->cat_id);
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Csrsubcategory $subcategory)
    {
        $this->subcategory = $subcategory;
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
     public function destroy(Csrsubcategory $subcategory)
    {
        $subcategory->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Document subcategory deleted successfully.');
        $this->reset(['subcategory']);
        $this->subcategory = null;
        return redirect()->route('admin.climatescience.research.subcategory');
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['subcategory']);
    }
}
