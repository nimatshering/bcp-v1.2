<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Guidancedocumentcategory;
use Illuminate\Support\Str;

class Guidancedocumentcategories extends Component
{
    public $category;
    public $cat_id;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'category.icon' => 'required',
        'category.name' => 'required',
        'category.slug' => 'nullable',
        'category.definition' => 'required'
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
      $categories = Guidancedocumentcategory::orderBy('created_at','desc')
				->where('cat_id','=',$this->cat_id)
				->paginate(10);
      return view('backend.livewire.admin.guidance-document-category.index', compact('categories'));
    }

    /**
     * store post
     *
     * @return void
     */
     public function store()
    {
        $this->validate();
        if(isset($this->category->id)){
            $this->category->slug = Str::slug($this->category['name'], '-');
            $this->category->save();
            session()->flash('message', 'Guidance document category updated successfully !');
        }else{
            Guidancedocumentcategory::create([
            'icon' =>   $this->category['icon'], 
            'cat_id' =>   $this->cat_id, 
            'name' =>   $this->category['name'], 
            'definition' =>   $this->category['definition'], 
            'slug' =>    Str::slug($this->category['name'], '-'), 
            ]);
            session()->flash('message', 'Guidance document category successfully created!');
            }
        
        $this->resetErrorBag(['category']);
        $this->confirmItemAdd = false;
        $this->category = null;
        return redirect()->route('admin.guidancedocument.category', $this->cat_id);
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Guidancedocumentcategory $category)
    {
        $this->category = $category;
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
     public function destroy(Guidancedocumentcategory $category)
    {
        $category->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Document category category deleted successfully.');
        $this->reset(['category']);
        $this->category = null;
        return redirect()->route('admin.guidancedocument.category');
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['category']);
    }
}
