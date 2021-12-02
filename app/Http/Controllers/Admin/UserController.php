<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Password;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        $roles = Role::all();
        return view('backend.admin.users.index',compact('users','roles'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = new CreateNewUser();
        $user = $newUser->create($request->only(['name','email','password','password_confirmation']));
        $user->roles()->sync($request->roles);

        Password::sendResetLink($request->only(['email']));
        $request->session()->flash('success', 'Users created successfully ');
        return redirect(route('admin.users.index'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user =User::findorfail($id);
        $user->update($request->except(['_token'], 'roles'));
        $user->roles()->sync($request->roles);
        $request->session()->flash('success', 'Users updated successfully ');
        return redirect(route('admin.users.index'));
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        User::destroy($id);
        $request->session()->flash('success', 'Users deleted successfully ');
        return redirect(route('admin.users.index'));
    }
}
