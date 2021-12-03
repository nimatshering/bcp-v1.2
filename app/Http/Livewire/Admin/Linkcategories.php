<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Linkcategory;
use Illuminate\Support\Str;


class Linkcategories extends Component
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
        $categories = Linkcategory::all();
        return view('backend.livewire.admin.link-category.index',compact('categories'));
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
            Linkcategory::create([
            'name' =>   $this->category['name'], 
            'slug' =>    Str::slug($this->category['name'], '-'), 
            ]);
            session()->flash('message', 'Resource category successfully created!');
            }
        $this->resetErrorBag(['category']);
        $this->confirmItemAdd = false;
        $this->category = null;
        return redirect()->route('admin.link.category');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Linkcategory $category)
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
     public function destroy(Linkcategory $category)
    {
        $category->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Link category deleted successfully.');
        $this->reset(['category']);
        $this->category = null;
        return redirect()->route('admin.link.category');
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
