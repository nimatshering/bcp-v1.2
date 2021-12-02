<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Actions\Fortify\CreateNewUser;
use Session;

class Users extends Component
{
    public $user;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'user.name' => 'required', 
        'user.email' => 'required', 
        'user.password' => 'required', 
        'user.confirm_password' => 'required', 
    ];


     /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
      $userList = User::paginate(10);
      $roles = Role::all();
      return view('backend.livewire.users.users', compact('userList','roles'));
    }


    /**
     * store post
     *
     * @return void
     */

     public function store()
    {
        // $this->validate();
         if(isset($this->user->id)){
            $this->user->save();
            $this->user->roles()->sync($user->roles);
            session()->flash('message', 'User successfully updated!');
        }else{
            $newUser = new CreateNewUser();
            $user = CreateNewUser::create($request->only(['name','email','password','confirm_password']));
            $user->roles()->sync($request->roles);
            session()->flash('message', 'User added successfully created!');
         }
        
        $this->reset(['user']);
        $this->confirmItemAdd = false;
        $this->user = null;
        $this->resetErrorBag(['user']);
        return back();
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(User $user)
    {
        $this->user = $user;
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
     public function destroy(User $user)
    {
        $user->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'User deleted successfully.');
        $this->user = null;
        return back();
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['user']);
    }
}
