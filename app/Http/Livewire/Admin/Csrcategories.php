<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Csrcategory;
use Illuminate\Support\Str;

class Csrcategories extends Component
{
    public $category;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'category.icon' => 'nullable',
        'category.name' => 'required',
        'category.slug' => 'nullable',
        'category.definition' => 'nullable'
    ];


     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
        $categories = Csrcategory::all();
        return view('backend.livewire.admin.csr-category.index',compact('categories'));
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
            session()->flash('message', 'Climate Science Research category updated successfully !');

        }else{
            Csrcategory::create([
            'icon' =>   $this->category['icon'], 
            'name' =>   $this->category['name'], 
            'definition' =>   $this->category['definition'], 
            'slug' =>    Str::slug($this->category['name'], '-'), 
            ]);

            session()->flash('message', 'Climate Science Research category successfully created!');
            }
        
        $this->resetErrorBag(['category']);
        $this->confirmItemAdd = false;
        $this->category = null;
        return redirect()->route('admin.climatescience.research.category');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Csrcategory $category)
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
     public function destroy(Csrcategory $category)
    {
        $category->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Climate Science Research category deleted successfully.');
        $this->reset(['category']);
        $this->category = null;
        return redirect()->route('admin.climatescience.research.category');
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
