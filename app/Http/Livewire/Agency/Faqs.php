<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Faq;


class Faqs extends Component
{
    use withPagination;

    public $faq;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
   
    protected $rules = [
        'faq.question' => 'required', 
        'faq.answer' => 'required', 
    ];


     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $faqs = Faq::all();
      return view('backend.livewire.agency.faqs.index', compact('faqs'));
    }


    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        $this->validate();
        if(isset($this->faq->id)){
            $this->faq->save();
            session()->flash('message', 'Faq successfully updated!');

        }else{
          Faq::create([
            'question' =>   $this->faq['question'], 
            'answer' =>   $this->faq['answer'], 
            ]);
            session()->flash('message', 'Faq successfully created!');
            }
        $this->resetErrorBag(['faq']);
        $this->faq = null;
        $this->confirmItemAdd = false;
        return redirect()->route('agency.faqs');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Faq $faq)
    {
        $this->faq = $faq;
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
     public function destroy(Faq $faq)
    {
        $faq->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Faq deleted successfully.');
        $this->faq = null;
        return redirect()->route('agency.faqs');
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['faq']);
    }
}
