<?php

namespace App\Http\Livewire\Agency;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Posts extends Component
{
    use withPagination;
    use WithFileUploads;

    public $post;
    public $postype;
    public $photo;
    public $filename;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'post.title' => 'required', 
        'post.summary' => 'required', 
        'post.description' => 'required', 
        'post.author' => 'required', 
        'post.published_at' => 'required', 
    ];

    /**
     * The livewire render function
     *
     * @return void
     */
    public function mount($postype)
    {
        $this->postype = $postype;
    }

     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $posts = Post::orderBy('created_at','desc')
				->where('type','=',$this->postype)
				->paginate(10);
      return view('backend.livewire.agency.posts.index', compact('posts'));
    }

    /**
     * store post
     *
     * @return void
     */
    public function store()
    {
        $this->validate();
        if(isset($this->post->id)){
            if(!empty($this->photo)){
                $this->validate(['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' ]);
                if (Storage::disk('uploads')->exists($this->post->photo)) {
                    Storage::disk('uploads')->delete($this->post->photo);
                }
                $this->post->photo = $this->photo->store('posts','uploads');
            }
            $this->post->slug= Str::slug($this->post->title, '-');
            $this->post->save();
            session()->flash('message', 'Post successfully updated!');

        }else{
                if(!empty($this->photo)){
                $this->validate(['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' ]);
                $filename = $this->photo->store('posts', 'uploads');
                }else{
                    $filename = null;
                }
            Post::create([
            'title' =>   $this->post['title'], 
            'slug' =>    Str::slug($this->post['title'], '-'), 
            'author' => $this->post['author'], 
            'summary' => $this->post['summary'],
            'description' => $this->post['description'],
            'photo' => $this->filename,
            'type' => $this->postype,
            'published_at' => $this->post['published_at'],
            ]);
            session()->flash('message', 'Post successfully created!');
            }
        $this->resetErrorBag(['post']);
        $this->confirmItemAdd = false;
        return back();
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Post $post)
    {
        $this->post = $post;
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
     public function destroy(Post $post)
    {
		$post->delete();
        Storage::disk('uploads')->delete($post->photo);
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Post deleted successfully.');
        $this->photo = null;
        return redirect()->route('agency.posts',$this->postype);
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['post']);
    }
}
