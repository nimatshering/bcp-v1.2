<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainingmaterial;

class TrainingmaterialController extends Controller
{
   public function index()
    {
        $trainingmaterials = Trainingmaterial::paginate(10);
        return view('backend.agency.trainingmaterials.index',compact('trainingmaterials'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainingmaterial = Trainingmaterial::latest()->first();
        return view('backend.agency.trainingmaterials.create',compact('trainingmaterial'));
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

          Trainingmaterial::create([
          'name' =>   $request->input('name'), 
          'description' =>   $request->input('description'), 
          ]);
        session()->flash('message', 'Training material successfully added!');
      return redirect()->route('agency.trainingmaterial.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $trainingmaterial = Trainingmaterial::findOrFail($id);
      return view('backend.agency.trainingmaterials.edit',compact('trainingmaterial'));
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
      $trainingmaterial = Trainingmaterial::findOrFail($id);
      $trainingmaterial->name = $request->input('name');
      $trainingmaterial->description = $request->input('description');
      $trainingmaterial->save();
      session()->flash('message', 'Training material updated successfully');
      return redirect()->route('agency.trainingmaterial.index');
     }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $trainingmaterial = Trainingmaterial::findOrFail($id);
        $trainingmaterial->delete();
        session()->flash('message', 'Training material updated successfully');
        return redirect()->route('agency.researchstudy.index');
    }
}
