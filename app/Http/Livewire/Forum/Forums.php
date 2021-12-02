<?php

namespace App\Http\Livewire\Forum;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Forum;
use App\Models\Forumcategory;
use Auth;
use Gate;

class Forums extends Component
{
    use withPagination;
    use WithFileUploads;

    public $discussion;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
      'discussion.category_id' => 'required', 
      'discussion.topic' => 'required', 
      'discussion.summary' => 'required', 
      'discussion.content' => 'required', 
    ];

     /**
     * The livewire render function
     * @return void
     */
    public function render()
    {
      $categories = Forumcategory::all();
      if (Gate::allows('is-agency')) {
             $layout = 'layouts.app';
      }else{
          $layout = 'layouts.guest';
      }
      $discussions = Forum::where('user_id','=', Auth::user()->id )->orderBy('created_at','desc')->paginate(10);
      return view('backend.livewire.forum.index', compact('discussions','categories'))
             ->layout($layout);
    }

    /**
     * store event
     * @return void
     */
    public function store()
    {
      $this->validate();
      if(isset($this->discussion->id)){
        $this->discussion->save();
        session()->flash('message', 'Discussions successfully updated!');
      }else{


        Forum::create([
        'category_id' => $this->discussion['category_id'], 
        'user_id' => Auth::user()->id,
        'topic' => $this->discussion['topic'],
        'summary' => $this->discussion['summary'],
        'content' => $this->discussion['content'],
        ]);

        session()->flash('message', 'Topic successfully created!');
      }
      $this->resetErrorBag(['discussion']);
      $this->confirmItemAdd = false;

    
      if (Gate::allows('is-agency')) {
          $path = 'agency';
      }else{
          $path = 'forum';
      }


      return redirect()->route($path.'.forum.index');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Forum $discussion)
    {
      $this->discussion = $discussion;
      $this->confirmItemAdd = true;
    }

    /**
     * Display confim event deletion modal.
     */

    public function showDeleteModal($id)
    {
      $this->confirmItemDeletion = $id;
    }

     
     /**
      * Delete event item
      *
      * @param  mixed $id
      * @return void
      */
    public function destroy(Forum $discussion)
    {
      $discussion->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Topic deleted successfully.');
      return redirect()->route('agency.forum.index');
    }

      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['discussion']);
    }
}
