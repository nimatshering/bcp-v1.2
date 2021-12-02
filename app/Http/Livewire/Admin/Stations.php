<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Station;
use App\Models\StationType;
use App\Models\Dzongkhag;
use App\Models\Gewog;

class Stations extends Component
{
    public $station;
    public $dzongkhags;
    public $dzongkhag_id;
    public $gewogs;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'station.station_id' => 'required',
        'station.name' => 'required', 
        'station.latitude' => 'nullable',
        'station.longitude' => 'nullable',
        'station.dzongkhag_id' => 'required',
        'station.gewog_id' => 'required',
        'station.location' => 'nullable',
        'station.station_type_id' => 'required',
    ];


    public function mount()
    {
      $this->dzongkhags = Dzongkhag::all();
      $this->gewogs = collect();
    }

    public function render()
    {
        $stationlist = Station::all();
        $typelist = StationType::all();
        return view('backend.livewire.admin.stations.index', compact('stationlist','typelist'));
    }


    public function  updatedStationDzongkhagId($dzongkhag_id){
       $this->gewogs = Gewog::where('dzongkhag_id',$dzongkhag_id)->get();
       $this->dzongkhag_id = $dzongkhag_id;
    }

    /**
     * store post
     *
     * @return void
     */

    public function store()
    {
        $this->validate();
         if(isset($this->station->id)){
            $this->station->save();
            session()->flash('message', 'Station successfully updated!');
        }else{
            Station::create([
            'station_id' =>   $this->station['station_id'], 
            'name' =>   $this->station['name'],
            'latitude' =>   $this->station['latitude'],
            'longitude' =>   $this->station['longitude'],
            'dzongkhag_id' =>   $this->station['dzongkhag_id'],
            'gewog_id' =>   $this->station['gewog_id'],
            'location' =>   $this->station['location'],
            'station_type_id' =>   $this->station['station_type_id'],
            ]);
            session()->flash('message', 'Station successfully created!');
         }
        
        $this->reset(['station']);
        $this->confirmItemAdd = false;
        $this->station = null;
        $this->resetErrorBag(['station']);
        return redirect()->route('admin.stations');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Station $station)
    {
        $this->gewogs = Gewog::where('dzongkhag_id',$station->dzongkhag_id)->get();
        $this->station = $station;
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
     public function destroy(Station $station)
    {
        $station->delete();
        $this->confirmItemDeletion = false;
        session()->flash('message', 'Station deleted successfully.');
        $this->station = null;
        
        $this->confirmItemAdd = false;
        $this->resetErrorBag(['station']);
        return redirect()->route('admin.stations');
    }


      /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->resetErrorBag(['station']);
        return redirect()->route('admin.stations');
    }

}
