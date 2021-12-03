<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Programproject;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProgramprojectController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proj = Programproject::latest()->first();
        return view('backend.agency.programprojects.create',compact('proj'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'title' => 'required',
        'funding' => 'required',
        'amount' => 'required',
        'agency' => 'required',
        'start_at' => 'required',
        'end_at' => 'required',
        'status' => 'required',
        'type_id' => 'required',
        'description' => 'nullable',
        'category_id' => 'required',
        ]);


          Programproject::create([
          'title' =>   $request->input('title'), 
          'slug' =>    Str::slug($request->input('title'), '-'),             
          'funding' =>   $request->input('funding'), 
          'amount' =>   $request->input('amount'), 
          'agency' =>   $request->input('agency'), 
          'start_at' =>   $request->input('start_at'), 
          'end_at' =>   $request->input('end_at'), 
          'status' =>   $request->input('status'), 
          'type_id' =>   $request->input('type_id'), 
          'description' =>   $request->input('description'), 
          'category_id' => $request->input('category_id'),
          ]);
        session()->flash('message', 'Project successfully added!');
      return redirect()->route('agency.programprojects.show',$request->input('category_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($catID)
    {
        $programprojects = Programproject::orderBy('created_at','asc')->where('category_id','=',$catID)->paginate(10);
        return view('backend.agency.programprojects.show',compact('programprojects','catID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programproject = Programproject::findOrFail($id);
        return view('backend.agency.programprojects.edit',compact('programproject'));
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
      $request->validate([
        'title' => 'nullable',
        'funding' => 'required',
        'amount' => 'required',
        'agency' => 'required',
        'start_at' => 'required',
        'end_at' => 'required',
        'status' => 'required',
        'type_id' => 'required',
        'description' => 'nullable',
        'category_id' => 'required',
      ]);
    
      $programproject = Programproject::findOrFail($id);
      $programproject->title = $request->input('title');
      $programproject->slug = Str::slug($request->input('title'), '-');
      $programproject->funding = $request->input('funding');
      $programproject->amount = $request->input('amount');
      $programproject->agency = $request->input('agency');
      $programproject->start_at = $request->input('start_at');
      $programproject->end_at = $request->input('end_at');
      $programproject->status = $request->input('status');
      $programproject->type_id = $request->input('type_id');
      $programproject->description = $request->input('description');
      $programproject->category_id = $request->input('category_id');
      $programproject->save();

      session()->flash('message', 'Programproject updated successfully');
      return redirect()->route('agency.programprojects.show', $request->input('category_id'));
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programproject = Researchstudy::findOrFail($id);
        $programproject->delete();
        session()->flash('message', 'Research study updated successfully');
        return redirect()->route('agency.programprojects.index');
    }
}
