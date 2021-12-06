<?php

namespace App\Http\Livewire\Agency;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Greenhousegas;
use App\Models\Sector;
use App\Models\Parameter;
use Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GHGDataImport;

class GreenhouseGases extends Component
{
   public $data;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
      'data.sector_id' => 'required', 
      'data.year' => 'required',
      'data.data' => 'required',
      'data.data_source' => 'nullable',
    ];

     /**
     * Render function
     */
    public function render()
    {
      $sectorlist = Sector::all();
      $datalist = Greenhousegas::orderBy('year','desc')->get();
      $parameterlist = Parameter::all();
      return view('backend.livewire.agency.ghg-data.greenhouse-gases', compact('datalist','parameterlist', 'sectorlist'));
    }

    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
      $this->validate();
        if(isset($this->data->id)){
          $this->data->save();
          session()->flash('message', 'Data successfully updated!');
      }else{
        Greenhousegas::create([
        'sector_id' =>   $this->data['sector_id'],
        'year' =>   $this->data['year'],
        'data' =>   $this->data['data'],
        'data_source' =>   $this->data['data_source'],
        'user_id' => Auth::user()->id,
        ]);
        session()->flash('message', 'Data successfully created!');
        }
      $this->reset(['data']);
      $this->confirmItemAdd = false;
      $this->data = null;
      return back();
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Greenhousegas $data)
    {
      $this->data = $data;
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
      * @param  mixed $id
      * @return void
      */
    public function destroy(Greenhousegas $data)
    {
      $data->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Data deleted successfully.');
      $this->data = null;
      return back();
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->reset(['data']);
    }


    /**
     * store post
     *
     * @return void
     */
    public function ghgExcelImport(Request $request)
    {
      $file = $request->file('datafile');
      Excel::import(new GHGDataImport,$file);
      session()->flash('message', 'Excel data successfully imported!');
      return back();
    }
}
