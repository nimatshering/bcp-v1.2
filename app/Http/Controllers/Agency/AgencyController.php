<?php

namespace App\Http\Controllers\Agency;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /*-----------------------------------------------------
    |Show agency dashboard.
    |------------------------------------------------------
    */
    public function dashboard()
    {
      return view('backend.agency.dashboard');
    }
}
