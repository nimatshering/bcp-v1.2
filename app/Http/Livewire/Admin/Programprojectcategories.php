<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Programprojectcategory;
use Illuminate\Support\Str;

class Programprojectcategories extends Component
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
        $categories = Programprojectcategory::all();
        return view('backend.livewire.admin.projectprogram-category.index',compact('categories'));
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
            Programprojectcategory::create([
            'icon' =>   $this->category['icon'], 
            'name' =>   $this->category['name'], 
            'definition' =>   $this->category['definition'], 
            'slug' =>    Str::slug($this->category['name'], '-'), 
            ]);
            session()->flash('message', 'Guidance document category successfully created!');
            }
        
        $this->resetErrorBag(['category']);
        $this->confirmItemAdd = false;
        $this->category = null;
        return redirect()->route('admin.projectprogram.category');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Programprojectcategory $category)
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
     public function destroy(Programprojectcategory $category)
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
