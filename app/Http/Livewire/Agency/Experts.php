<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Expert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Experts extends Component
{
    use withPagination;
    use WithFileUploads;

    public $expert;
    public $photo;
    public $filename;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'expert.name' => 'required', 
        'expert.field' => 'required', 
        'expert.qualification' => 'required', 
        'expert.description' => 'required', 
    ];

     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $experts = Expert::orderBy('created_at','desc')->paginate(10);
      return view('backend.livewire.agency.experts.index', compact('experts'));
    }

    /**
     * store expert
     *
     * @return void
     */
    public function store()
    {
        $this->validate();
        if(isset($this->expert->id)){
            if(!empty($this->photo)){
                $this->validate(['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' ]);
                if (Storage::disk('uploads')->exists($this->expert->photo)) {
                    Storage::disk('uploads')->delete($this->expert->photo);
                }
                $this->expert->photo = $this->photo->storeAs('experts', time().'.'.$this->photo->extension(),'uploads');
            }
            $this->expert->save();
            session()->flash('message', 'Expert information successfully updated!');
        }else{
                if(!empty($this->photo)){
                $this->validate(['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' ]);
                $this->filename = $this->photo->storeAs('experts', time().'.'.$this->photo->extension(),'uploads');
                }else{
                    $this->filename = null;
                }
            Expert::create([
            'name' =>   $this->expert['name'], 
            'field' => $this->expert['field'], 
            'qualification' => $this->expert['qualification'],
            'description' => $this->expert['description'],
            'photo' => $this->filename,
            ]);
            session()->flash('message', 'Expert successfully created!');
            }
        $this->resetErrorBag(['expert']);
        $this->confirmItemAdd = false;
        return back();
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Expert $expert)
    {
        $this->expert = $expert;
        $this->confirmItemAdd = true;
    }

    /**
     * Display confim expert deletion modal.
     */

    public function showDeleteModal($id)
    {
        $this->confirmItemDeletion = $id;
    }

     
     /**
      * Delete expert item
      *
      * @param  mixed $id
      * @return void
      */
     public function destroy(Expert $expert)
    {
		$expert->delete();
        Storage::disk('uploads')->delete($expert->photo);
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Expert deleted successfully.');
        $this->photo = null;
        return redirect()->route('agency.experts',$this->expertype);
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['expert']);
    }
}
