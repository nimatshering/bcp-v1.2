<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Csrcategory;
use App\Models\Csrsubcategory;
use App\Models\Csrdocument;

use App\Models\Guidancedocument;
use App\Models\Guidancedocumentcategory;
use App\Models\Guidancecategory;

use App\Models\Programproject;
use App\Models\Programprojectcategory;

class SearchController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Search ClimateS cience Research
    |--------------------------------------------------------------------------
    **/
    public function searchClimateScienceResearch(Request $request)
    {
        $searchkey = $request->input('searchkey');
        $searchby = $request->input('searchby');

        $cat = $request->input('category');
        $subcat = $request->input('subcategory');

        $category = Csrcategory::where('id',$cat)->first();
        $subcategory = Csrsubcategory::where('id',$subcat)->first();
        $subcategories = Csrsubcategory::where('cat_id',$cat)->get();
       
        if($searchby == 'title'){
           $publications = Csrdocument::where('subcategory_id',$subcat)->where("title","LIKE","%$searchkey%")->latest()->paginate(10);
        }else{
            $publications = Csrdocument::where('subcategory_id',$subcat)->where("author","LIKE","%$searchkey%")->latest()>paginate(10);
        }
       
        return view('frontpages.climate-science-research.publications', compact('category','subcategory','subcategories','publications'));
    }

    /*
    |--------------------------------------------------------------------------
    | Search Guidance Documents
    |--------------------------------------------------------------------------
    **/
    public function searchGuidanceDocument(Request $request)
    {
        $searchkey = $request->input('searchkey');
        $searchby = $request->input('searchby');
        $cat = $request->input('category');
        $subcat = $request->input('subcategory');

        $category = Guidancecategory::where('id',$cat)->first();
        $subcategory = Guidancedocumentcategory::where('id',$subcat)->first();
        $subcategories = $category->subcategory;

        if($searchby == 'title'){
           $publications = Guidancedocument::where('category_id',$subcat)->where("title","LIKE","%$searchkey%")->latest()->paginate(10);
        }else{
            $publications = Guidancedocument::where('category_id',$subcat)->where("author","LIKE","%$searchkey%")->latest()->paginate(10);
        }
        return view('frontpages.guidance-document.publications', compact('category','subcategory','subcategories','publications'));
    }


    /*
    |--------------------------------------------------------------------------
    | Search Guidance Documents
    |--------------------------------------------------------------------------
    **/

    public function searchprojectprogramDocument(Request $request)
    {
        $searchkey = $request->input('searchkey');
        $searchby = $request->input('searchby');
        $category = $request->input('category');
        $programprojectcategories = Programprojectcategory::all();
        $programprojectcategory = Programprojectcategory::where('id',$category)->first();
        if($searchby == 'title'){
           $publications = Programproject::where('category_id',$category)->where("title","LIKE","%$searchkey%")->latest()->paginate(10);
        }elseif($searchby == 'agency'){
           $publications = Programproject::where('category_id',$category)->where("agency","LIKE","%$searchkey%")->latest()->paginate(10);
        }elseif($searchby == 'funding'){
           $publications = Programproject::where('category_id',$category)->where("funding","LIKE","%$searchkey%")->latest()->paginate(10);
        }else{
            $publications = Programproject::where('category_id',$category)->paginate(10);
        }
        return view('frontpages.project-program.publications', compact('programprojectcategories','programprojectcategory','publications'));
    }
    
}
