<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Event;
use App\Models\About;
use App\Models\Guidancecategory;
use App\Models\Guidancedocumentcategory;
use App\Models\Guidancedocument;
use App\Models\Expert;
use App\Models\Trainingmaterial;
use App\Models\Researchstudydocument;

use App\Models\Csrcategory;
use App\Models\Csrsubcategory;
use App\Models\Csrdocument;
use App\Models\Researchstudy;
use App\Models\Media;

use App\Models\Programprojectcategory;
use App\Models\Projectdocument;

use App\Mail\ContactMail;
use Illuminate\Support\Arr;
use Mail;
use Session;

class FrontpageController extends Controller
{
  /*------------------------------------------------------------------------
  | Show landing page
  |--------------------------------------------------------------------------
  */
    public function index()
    {
      $medias = Media::latest()->take(3)->get();
      return view('frontpages.landing', compact('medias'));
    }

    /*-------------------------------------------------------------------------
    | Show CSR-category
    |--------------------------------------------------------------------------
    */
    public function csrCategory()
    {
        $categories = Csrcategory::all();
        $subcategories = Csrsubcategory::all();
        return view('frontpages.climate-science-research.index',compact('categories','subcategories'));
    }
    

    /*-------------------------------------------------------------------------
    | Show CSR Sub-Category 
    |--------------------------------------------------------------------------
    */
    public function csrSubCategory($slug)
    {
      $category = Csrcategory::where('slug',$slug)->first();
      $subcategories = $category->subcategories;
      $subcategory = $subcategories->first();
      $publications = $subcategory->documents;
      return view('frontpages.climate-science-research.subcategory', compact('category','subcategories','subcategory','publications'));
    }



     /*-------------------------------------------------------------------------
    | Show CSR Document 
    |--------------------------------------------------------------------------
    */
    public function csrDocument($slug)
    {
      $subcategory = Csrsubcategory::where('slug',$slug)->first();
      $category = Csrcategory::where('id',$subcategory->cat_id)->first();
      $subcategories = $category->subcategories;
      $publications = $subcategory->documents;
      return view('frontpages.climate-science-research.publications', compact('category','subcategory','subcategories','publications'));
    }


    /*-------------------------------------------------------------------------
    |  CSR document download 
    |--------------------------------------------------------------------------
    */
    public function csrDownload($slug) {
        $csrdocument = Csrdocument:: where('slug', $slug)->firstOrFail();
        $file_path = public_path('/uploads/' . $csrdocument->document);
        return response()->download($file_path);
    }

    


    /*-------------------------------------------------------------------------
    | Show guidance-document
    |--------------------------------------------------------------------------
    */
    public function guidanceCategory()
    {
        $guidancecategories = Guidancecategory::all();
        $guidancedocumentcategories = Guidancedocumentcategory::all();
        return view('frontpages.guidance-document.index',compact('guidancecategories','guidancedocumentcategories'));
    }
    

    /*-------------------------------------------------------------------------
    | Show guidance Document Category 
    |--------------------------------------------------------------------------
    */
    public function guidanceSubCategory($slug)
    {
      $category = Guidancecategory::where('slug',$slug)->first();
      $subcategories = $category->subcategory;
      $subcategory = $subcategories->first();
      $publications = $subcategory->documents;
      return view('frontpages.guidance-document.subcategory', compact('category','subcategories','subcategory','publications'));
    }



     /*-------------------------------------------------------------------------
    | Show guidance Document Category 
    |--------------------------------------------------------------------------
    */
    public function guidanceDocument($slug)
    {

      $subcategory = Guidancedocumentcategory::where('slug',$slug)->first();
      $category = Guidancecategory::where('id',$subcategory->cat_id)->first();
      $subcategories = $category->subcategory;
      $publications = $subcategory->documents;
      return view('frontpages.guidance-document.publications', compact('category','subcategory','subcategories','publications'));
    }

    /*-------------------------------------------------------------------------
    |  Gudiance document download 
    |--------------------------------------------------------------------------
    */
    public function guidanceDownload($slug) {
        $guidancedocument = Guidancedocument:: where('slug', $slug)->firstOrFail();
        $file_path = public_path('/uploads/' . $guidancedocument->document);
        return response()->download($file_path);
    }


     /*-------------------------------------------------------------------------
    | Show Project & Programs-document
    |--------------------------------------------------------------------------
    */
    public function projectprograms()
    {
        $programprojectcategories = Programprojectcategory::all();
        return view('frontpages.project-program.index',compact('programprojectcategories'));
    }
/*-------------------------------------------------------------------------
    | Show science and research page 
    |--------------------------------------------------------------------------
    */
    public function projectprogramDocumentCategory($slug)
    {
      $programprojectcategories = Programprojectcategory::all();
      $programprojectcategory = Programprojectcategory::where('slug',$slug)->first();
      $publications = $programprojectcategory->projects()->latest()->where('status','!=','completed')->paginate(10);
      return view('frontpages.project-program.publications', compact('programprojectcategories','programprojectcategory','publications'));
    }


    /*-------------------------------------------------------------------------
    |  Gudiance document download 
    |--------------------------------------------------------------------------
    */
    public function projectprogramDownload($id) {
        $projectdocument = Projectdocument:: where('id', $id)->firstOrFail();
        $file_path = public_path('/uploads/' . $projectdocument->document);
        return response()->download($file_path);
    }

     /*------------------------------------------------------------------------
    | Show trainingmaterials
    |--------------------------------------------------------------------------
    **/
    public function trainingmaterials()
    {
				$trainingmaterials = Trainingmaterial::paginate(10);
        return view('frontpages.training-events.trainingmaterial', compact('trainingmaterials'));
    }

      /*-------------------------------------------------------------------------
    |  training material download 
    |--------------------------------------------------------------------------
    */
    public function trainingmaterialDownload($id) {
        $trainingdocument = Trainingdocument:: where('id', $id)->firstOrFail();
        $file_path = public_path('/uploads/' . $trainingdocument->document);
        return response()->download($file_path);
    }

     /*------------------------------------------------------------------------
    | Show datasets
    |--------------------------------------------------------------------------
    **/
    public function researchstudies()
    {
				$researchstudies = Researchstudy::paginate(10);
        return view('frontpages.analysed-data.researchstudy.index', compact('researchstudies'));
    }

       /*-------------------------------------------------------------------------
    |  training material download 
    |--------------------------------------------------------------------------
    */
    public function researchstudyDownload($id) {
        $researchdocs = Researchstudydocument:: where('id', $id)->firstOrFail();
        $file_path = public_path('/uploads/' . $researchdocs->document);
        return response()->download($file_path);
    }

/*------------------------------------------------------------------------
|   | Show faq page
|   |--------------------------------------------------------------------------
    */
    public function mediagallery()
    {
      $mediagallery = Media::latest()->paginate(10);
      return view('frontpages.mediagallery', compact('mediagallery'));
    }

    /*------------------------------------------------------------------------
|   | Show faq page
|   |--------------------------------------------------------------------------
    */
    public function faqs()
    {
      $faqs = Faq::all();
      return view('frontpages.faq.index', compact('faqs','climatesciencecategories'));
    }


     /*------------------------------------------------------------------------
    | Show legislationspolicies page
    |--------------------------------------------------------------------------
    **/
    public function trainingEvents()
    {
        return view('frontpages.training-events.post');
    }

    /*------------------------------------------------------------------------
    | Show proposals page
    |--------------------------------------------------------------------------
    **/
    public function posts($type)
    {
			$posts = Post::where('type','=',$type)->paginate(10);
			if($type=='proposals')
				return view('frontpages.training-events.proposals', compact('posts'));
			elseif($type=='trainings')
				return view('frontpages.training-events.trainings', compact('posts'));
    }

    /*------------------------------------------------------------------------
    | Show proposals page
    |--------------------------------------------------------------------------
    **/
    public function showPost($slug)
    {
      $post = Post::where('slug','=',$slug)->first();
      return view('frontpages.training-events.show', compact('post'));
    }

    /*------------------------------------------------------------------------
    | Show events page
    |--------------------------------------------------------------------------
    **/
    public function events()
    {
				$events = Event::paginate(10);
        return view('frontpages.training-events.events', compact('events'));
    }


     /*------------------------------------------------------------------------
    | Show experts 
    |--------------------------------------------------------------------------
    **/
    public function experts()
    {
				$experts = Expert::paginate(5);
        return view('frontpages.training-events.experts', compact('experts'));
    }

    /*------------------------------------------------------------------------
    | Show about page
    |--------------------------------------------------------------------------
    **/
    public function about()
    {
        $about = About::latest()->first();
        return view('frontpages.about', compact('about'));
    }
    
    /*------------------------------------------------------------------------
    | Show  contact us page
    |--------------------------------------------------------------------------
    **/
    public function contact()
    {
        return view('frontpages.contact');
    }

      /*------------------------------------------------------------------------
    | Show Disaster Data
    |--------------------------------------------------------------------------
    **/
     public function getData()
    {
        return view('frontpages.analysed-data.disaster-data.index');
    }




    /*
    |--------------------------------------------------------------------------
    | Show contact us page
    |--------------------------------------------------------------------------
    **/
    public function sendEmail()
    {
       $contactus = request()->validate([
         'name' => 'required',
         'email' => 'required|email',
         'subject' => 'required',
         'message' => 'required',
        //  'g-recaptcha-response' => ['required', new GoogleRecaptcha]
       ]); 

       
        //send email
        $contactus = Arr::add($contactus, 'title', 'Email form BCP');
        $contactus = Arr::add($contactus, 'url', 'http://bcp.nec.bt');
        $email = 'bcpbhutan@gmail.com';

        Mail::to($email)->send(new ContactMail($contactus));

        Session::flash('success', 'Thank you for contacting us. We will get back to you as soon as possible ');
        return view('frontpages.emailsuccess');
    }


}
