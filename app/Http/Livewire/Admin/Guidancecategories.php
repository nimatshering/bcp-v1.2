<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Guidancecategory;
use Illuminate\Support\Str;
 

class Guidancecategories extends Component
{

   public $category;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'category.name' => 'required',
        'category.slug' => 'nullable',
    ];


     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
        $categories = Guidancecategory::all();
        return view('backend.livewire.admin.guidance-category.index',compact('categories'));
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
            session()->flash('message', 'Guidance category updated successfully !');
        }else{
            Guidancecategory::create([
            'name' =>   $this->category['name'], 
            'slug' =>    Str::slug($this->category['name'], '-'), 
            ]);
            session()->flash('message', 'Guidance category successfully created!');
            }
        
        $this->resetErrorBag(['category']);
        $this->confirmItemAdd = false;
        $this->category = null;
        return redirect()->route('admin.guidance.category');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Guidancecategory $category)
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
     public function destroy(Guidancecategory $category)
    {
        $category->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Guidance category deleted successfully.');
        $this->reset(['category']);
        $this->category = null;
        return redirect()->route('admin.guidance.category');
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
