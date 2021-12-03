<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Link;
use Illuminate\Support\Str;


class Links extends Component
{
    public $link;
    public $link_id;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'link.name' => 'required',
        'link.linkurl' => 'required',
        'link.slug' => 'nullable',
    ];

     /**
     * The livewire render function
     *
     * @return void
     */
    public function mount($link_id)
    {
        $this->link_id = $link_id;
    }

     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $links = Link::orderBy('created_at','desc')
				->where('link_id','=',$this->link_id)->paginate(10);
      return view('backend.livewire.admin.links.index', compact('links'));
    }

    /**
     * store post
     *
     * @return void
     */
     public function store()
    {
        $this->validate();
        if(isset($this->link->id)){
            $this->link->slug = Str::slug($this->link['name'], '-');
            $this->link->save();
            session()->flash('message', 'Link updated successfully !');
        }else{
            Link::create([
            'name' =>   $this->link['name'], 
            'linkurl' =>   $this->link['linkurl'], 
            'slug' =>    Str::slug($this->link['name'], '-'), 
            'link_id' =>   $this->link_id,
            ]);
            session()->flash('message', 'Link successfully created!');
            }
        
        $this->resetErrorBag(['link']);
        $this->confirmItemAdd = false;
        $this->link = null;
        return redirect()->route('admin.links', $this->link_id);
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Link $link)
    {
        $this->link = $link;
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
     public function destroy(Link $link)
    {
        $link->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Document link deleted successfully.');
        $this->reset(['link']);
        $this->link = null;
        return redirect()->route('admin.links',$this->link_id);
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['link']);
    }
}
