<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Researchstudy;

class ResearchstudyController extends Controller
{
    public function index()
    {
        $researchstudies = Researchstudy::paginate(10);
        return view('backend.agency.researchstudies.index',compact('researchstudies'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $researchstudy = Researchstudy::latest()->first();
        return view('backend.agency.researchstudies.create',compact('researchstudy'));
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
        'name' => 'required',
        'description' => 'nullable',
        ]);

          Researchstudy::create([
          'name' =>   $request->input('name'), 
          'description' =>   $request->input('description'), 
          ]);
        session()->flash('message', 'Researchstudy document successfully added!');
      return redirect()->route('agency.researchstudy.index');

      
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $researchstudy = Researchstudy::findOrFail($id);
      return view('backend.agency.researchstudies.edit',compact('researchstudy'));
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
        'name' => 'required',
        'description' => 'nullable',
      ]);
      
      $researchstudy = Researchstudy::findOrFail($id);
      $researchstudy->name = $request->input('name');
      $researchstudy->description = $request->input('description');
      $researchstudy->save();
      session()->flash('message', 'Research Study updated successfully');
      return redirect()->route('agency.researchstudy.index');
     }

     

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $researchstudy = Researchstudy::findOrFail($id);
        $researchstudy->delete();
        session()->flash('message', 'Research study updated successfully');
        return redirect()->route('agency.researchstudy.index');
    }
}
