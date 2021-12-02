<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Forumcategory;

class Forumcategories extends Component
{
    use withPagination;
    use WithFileUploads;

    public $category;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
      'category.name' => 'required', 
    ];

     /**
     * The livewire render function
     * @return void
     */
    public function render()
    {
      $categories = Forumcategory::all();
      return view('backend.livewire.admin.forum-category.index', 
             compact('categories'));
    }

    /**
     * store category
     * @return void
     */
    public function store()
    {
      $this->validate();
      if(isset($this->category->id)){
        $this->category->save();
        session()->flash('message', 'Forum category successfully updated!');
      }else{
      Forumcategory::create([
        'name' =>   $this->category['name'], 
        ]);
        session()->flash('message', 'Forum category successfully created!');
        }
      $this->resetErrorBag(['category']);
      $this->category = null;
      $this->confirmItemAdd = false;
      return redirect()->route('admin.forum.category');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Forumcategory $category)
    {
      $this->category = $category;
      $this->confirmItemAdd = true;
    }

    /**
     * Display confim category deletion modal.
     */
    public function showDeleteModal($id)
    {
      $this->confirmItemDeletion = $id;
    }

     /**
      * Delete category item
      * @param  mixed $id
      * @return void
      */
    public function destroy(Forumcategory $category)
    {
      $category->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Forum category deleted successfully.');
      $this->category = null;
      return redirect()->route('admin.forum.category');
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
