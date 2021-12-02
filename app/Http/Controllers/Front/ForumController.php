<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Forum;
use App\Models\Forumcategory;
use App\Models\Comment;

class ForumController extends Controller
{
  /*------------------------------------------------------------------------
    | Show discussion Forum dashboard
    |--------------------------------------------------------------------------
    **/
    public function dashboard()
    {
        return view('backend.forum.dashboard');
    }

  /*------------------------------------------------------------------------
    | Show discussion Forum index page
    |--------------------------------------------------------------------------
    **/
    public function index()
    {
        $forumposts = Forum::orderBy('created_at','desc')->paginate(5);
        $recentpost = Forum::orderBy('id','asc')->take(5)->get();
        return view('frontpages.forum.index',compact('forumposts','recentpost'));
    }

     /*------------------------------------------------------------------------
    | Show discussion topic
    |--------------------------------------------------------------------------
    **/
    public function show($id)
    {
        $post = Forum::findOrFail($id);
        $recentpost = Forum::orderBy('id','asc')->take(5)->get();
        return view('frontpages.forum.show',compact('post','recentpost'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postComment(Request $request, $id)
    {
      $request->validate([
        'username' => 'required',
        'comment' => 'required',
      ]);

      Comment::create([
        'post_id' => $id, 
        'username' => $request->input('username'),
        'comment' => $request->input('comment'),
        ]);
        return redirect(route('showforum', $id));
    }

    


    

}
