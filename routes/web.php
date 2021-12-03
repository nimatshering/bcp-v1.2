<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Profile;

use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\Admin\Sectors;
use App\Http\Livewire\Admin\Parameters;
use App\Http\Livewire\Admin\Grids;
use App\Http\Livewire\Admin\Stations;
use App\Http\Livewire\Admin\StationTypes;
use App\Http\Livewire\Admin\DisasterTypes;
use App\Http\Livewire\Admin\DisasterParameters;
use App\Http\Livewire\Admin\Guidancecategories;
use App\Http\Livewire\Admin\Guidancedocumentcategories;
use App\Http\Livewire\Admin\Programprojectcategories;
use App\Http\Livewire\Admin\Csrcategories;
use App\Http\Livewire\Admin\Csrsubcategories;
use App\Http\Livewire\Admin\Statistics;
use App\Http\Livewire\Admin\Abouts;
use App\Http\Livewire\Admin\Medias;
use App\Http\Livewire\Admin\Linkcategories;
use App\Http\Livewire\Admin\Links;

use App\Http\Livewire\Agency\Climatescienceresearchs;
use App\Http\Livewire\Agency\Faqs;
use App\Http\Livewire\Agency\Posts;
use App\Http\Livewire\Agency\Events;
use App\Http\Livewire\Agency\Experts;
use App\Http\Livewire\Agency\Guidancedocuments;

use App\Http\Controllers\Agency\AgencyController;
use App\Http\Controllers\Agency\ProgramprojectController;
use App\Http\Controllers\Agency\TrainingmaterialController;
use App\Http\Controllers\Agency\ResearchstudyController;

use App\Http\Livewire\Agency\ClimateObservedDatas;
use App\Http\Livewire\Agency\ClimateProjectedDatas;
use App\Http\Livewire\Agency\ClimateReanalyzedDatas;
use App\Http\Livewire\Agency\TimeFrames;
use App\Http\Livewire\Agency\WaterObservedDatas;
use App\Http\Livewire\Agency\WaterProjectedDatas;
use App\Http\Livewire\Agency\GreenhouseGases;
use App\Http\Livewire\Agency\DisasterDatas;
use App\Http\Livewire\Agency\DisasterImpacts;


// use App\Http\Livewire\Admin\Forumcategories;
// use App\Http\Livewire\Forum\Forums;

use App\Http\Controllers\Front\FrontpageController;
use App\Http\Controllers\Front\DatareportController;
use App\Http\Controllers\Front\ForumController;
use App\Http\Controllers\Front\SearchController;

use App\Http\Livewire\Admin\ClimateModels;
use App\Http\Livewire\Admin\ClimateScenerios;
//Reports
use App\Http\Livewire\Reports\ClimateObservedReport;
use App\Http\Livewire\Reports\ClimateReanalyzedReport;
use App\Http\Livewire\Reports\ClimateProjectedReport;
use App\Http\Livewire\Reports\WaterObservedReport;
use App\Http\Livewire\Reports\WaterProjectedReport;
use App\Http\Livewire\Reports\DisasterDataReport;
use App\Http\Livewire\Reports\GhgReports;
use App\Http\Livewire\Reports\LandingReport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    //climate-science and research
    Route::get('/', [FrontpageController::class, 'index'])->name('landing');
    Route::get('/climate-science-research', [FrontpageController::class, 'csrCategory'])->name('climatescience.category');
    Route::get('/climate-science-research/{slug}', [FrontpageController::class, 'csrsubCategory'])->name('climatescience.subcategory');
    Route::get('/climate-science-research/category/{slug}', [FrontpageController::class, 'csrDocument'])->name('climatescience.document');
    Route::post('/climate-science-research/search', [SearchController::class, 'searchClimateScienceResearch'])->name('search.climatescience.document');
    Route::get('/research-publications/download/{slug}', [FrontpageController::class, 'csrDownload'])->name('climatescience.download');
    Route::get('/trainingmaterials', [FrontpageController::class, 'trainingmaterials'])->name('trainingmaterials');
    Route::get('/trainingmaterials/download/{id}', [FrontpageController::class, 'trainingmaterialDownload'])->name('trainingmaterial.download');
    Route::get('/researchstudies', [FrontpageController::class, 'researchstudies'])->name('researchstudies');
    Route::get('/researchstudies/download/{id}', [FrontpageController::class, 'researchstudyDownload'])->name('researchstudy.download');
    Route::get('/media-gallery/show', [FrontpageController::class, 'mediagallery'])->name('mediagallery');

     //Guidance document
    Route::get('/guidance-documents', [FrontpageController::class, 'guidanceCategory'])->name('guidance.category');
    Route::get('/guidance-documents/{slug}', [FrontpageController::class, 'guidanceSubCategory'])->name('guidance.subcategory');
    Route::get('/guidance-documents/category/{slug}', [FrontpageController::class, 'guidanceDocument'])->name('guidance.document');
    Route::post('/guidance-documents/search', [SearchController::class, 'searchGuidanceDocument'])->name('search.guidance.document');
    Route::get('/guidance-documents/download/{slug}', [FrontpageController::class, 'guidanceDownload'])->name('guidance.download');

       //Project and Program document
    Route::get('/projectprogram-documents', [FrontpageController::class, 'projectprograms'])->name('projectprograms');
    Route::get('/projectprogram/{slug}', [FrontpageController::class, 'projectprogramDocumentCategory'])->name('projectprogram.document.category');
    Route::post('/projectprogram/search', [SearchController::class, 'searchprojectprogramDocument'])->name('search.projectprogram.document');
    Route::get('/projectprogram/document/download/{id}', [FrontpageController::class, 'projectprogramDownload'])->name('projectdocument.download');

    //FAQs document
    Route::get('/climate-science/faqs', [FrontpageController::class, 'faqs'])->name('faqs');

    //training and events
    Route::get('/training-and-events', [FrontpageController::class, 'trainingEvents'])->name('trainingevents');
    Route::get('/training-and-events/post/{type}', [FrontpageController::class, 'posts'])->name('posts');
    Route::get('/training-and-events/show/{slug}', [FrontpageController::class, 'showPost'])->name('post.show');
    Route::get('/training-and-events/events', [FrontpageController::class, 'events'])->name('events');
    Route::get('/experts', [FrontpageController::class, 'experts'])->name('experts');

    //discussion forum
    Route::get('/about', [FrontpageController::class, 'about'])->name('about');
    // Route::get('/discussion-forum', [ForumController::class, 'index'])->name('discussionforum');
    // Route::get('/discussion-forum/post/{slug}', [ForumController::class, 'show'])->name('showforum');
    // Route::post('/post/comment/{id}', [ForumController::class, 'postComment'])->name('post.comment');
    
    //helpdesk
    Route::get('/contact', [FrontpageController::class, 'contact'])->name('contact');
    Route::post('/contact', [FrontpageController::class, 'sendEmail'])->name('send.email');

    //Data - Reports
    Route::get('/data', [DatareportController::class, 'analysedData'])->name('analysed.data');
    Route::get('/data/water-observed-report', [DatareportController::class, 'waterObservedReport'])->name('report.water_observed');
    Route::get('/data/water-projected-report', [DatareportController::class, 'waterProjectedReport'])->name('report.water_projected');
    Route::get('/data/water-observed-report/map', [DatareportController::class, 'waterObservedMap'])->name('report.water_observed.map');
    Route::post('/data/water-observed-report/map', [DatareportController::class, 'waterObservedMapReport'])->name('generate.waterobserved.map.data');

    Route::get('/data/climate-observed-report', [DatareportController::class, 'climateObservedReport'])->name('report.climate_observed');
    Route::get('/data/climate-observed-report/map', [DatareportController::class, 'ClimateObservedMap'])->name('report.climate_observed.map');
    Route::post('/data/climate-observed-report/map', [DatareportController::class, 'climateObservedMapReport'])->name('generate.climateobserved.map.data');

    Route::get('/data/climate-reanalyzed-report', [DatareportController::class, 'climateReanalyzedReport'])->name('report.climate_reanalyzed');
    Route::get('/data/climate-projected-report', [DatareportController::class, 'climateProjectedReport'])->name('report.climate_projected');
    Route::get('/data/disaster-report/map', [DatareportController::class, 'disasterReportMap'])->name('report.disaster.map');
    Route::get('/data/disaster-report/graph', [DatareportController::class, 'disasterReportGraph'])->name('report.disaster.graph');
    Route::post('/data/disaster-report/map', [DatareportController::class, 'mapReport'])->name('generate.map.data');

    Route::get('/data/ghg-report', [DatareportController::class, 'ghgReport'])->name('report.ghg');

    Route::post('/report/fetch_climate_data', [ClimateObservedReport::class, 'fetchClimateObservedData'])->name('report.fetch_climate_data');
    Route::post('/report/fetch_climate_data_boxplot', [ClimateObservedReport::class, 'fetchClimateObservedDataBoxPlot'])->name('report.fetch_climate_data_boxplot');
    Route::post('/report/fetch_climate_data_regression', [ClimateObservedReport::class, 'fetchClimateObservedDataRegression'])->name('report.fetch_climate_data_regression');
    Route::post('/report/cliimate_map', [LandingReport::class, 'firemap'])->name('report.firemap');
    
    Route::post('/report/fetch_climate_reanalyzed_data', [ClimateReanalyzedReport::class, 'fetchClimateReanalyzedData'])->name('report.fetch_climate_reanalyzed_data');
    Route::post('/report/fetch_climate_reanalyzed_data_boxplot', [ClimateReanalyzedReport::class, 'fetchClimateReanalyzedDataBoxPlot'])->name('report.fetch_climate_reanalyzed_data_boxplot');
    Route::post('/report/fetch_climate_reanalyzed_data_regression', [ClimateReanalyzedReport::class, 'fetchClimateReanalyzedDataRegression'])->name('report.fetch_climate_reanalyzed_data_regression');
    
    Route::post('/report/fetch_climate_projected_data', [ClimateProjectedReport::class, 'fetchClimateProjectedData'])->name('report.fetch_climate_projected_data');
    Route::post('/report/fetch_climate_projected_data_boxplot', [ClimateProjectedReport::class, 'fetchClimateProjectedDataBoxPlot'])->name('report.fetch_climate_projected_data_boxplot');
    Route::post('/report/fetch_climate_projected_data_regression', [ClimateProjectedReport::class, 'fetchClimateProjectedDataRegression'])->name('report.fetch_climate_projected_data_regression');

    Route::post('/report/fetch_water_data', [WaterObservedReport::class, 'fetchWaterObservedData'])->name('report.fetch_water_data');
    Route::post('/report/fetch_water_data_boxplot', [WaterObservedReport::class, 'fetchWaterObservedDataBoxPlot'])->name('report.fetch_water_data_boxplot');
    Route::post('/report/fetch_water_observed_data_regression', [WaterObservedReport::class, 'fetchWaterObservedDataRegression'])->name('report.fetch_water_observed_data_regression');

    Route::post('/report/fetch_water_projected_data', [WaterProjectedReport::class, 'fetchWaterProjectedData'])->name('report.fetch_water_projected_data');
    Route::post('/report/fetch_water_projected_data_boxplot', [WaterProjectedReport::class, 'fetchWaterProjectedDataBoxPlot'])->name('report.fetch_water_projected_data_boxplot');
    Route::post('/report/fetch_water_projected_data_regression', [WaterProjectedReport::class, 'fetchWaterProjectedDataRegression'])->name('report.fetch_water_projected_data_regression');
    Route::post('/report/fetch_ghg_data', [GhgReports::class, 'fetchGhgData'])->name('report.fetch_ghg_data');

    Route::post('/report/fetch_minmax_climate_data', [LandingReport::class, 'fetchMinMaxTempData'])->name('report.fetch_minmax_climate_data');
    Route::post('/report/fetch_prep_data', [LandingReport::class, 'fetchPrepData'])->name('report.fetch_prep_data');
    
    Route::post('/report/fetch_disaster_data', [LandingReport::class, 'fetchDisasterData'])->name('report.fetch_disaster_data');
    Route::post('/report/firemap', [LandingReport::class, 'firemap'])->name('report.firemap');

    Route::post('/report/fetch_overall_climate_data', [LandingReport::class, 'fetchOverallTempData'])->name('report.fetch_overall_climate_data');
    Route::post('/report/fetch_landing_ghg_data', [LandingReport::class, 'fetchGhgData'])->name('report.fetch_landing_ghg_data');


    /*---------------------------------------------------------------------------------------
    | Group route for Admin Panel 
    |----------------------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware('auth:sanctum','hasRole:admin')->name('admin.')->group(function(){
      Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
      Route::get ('/dashboard/profile', Profile::class)->name('profile');
      Route::resource('/dashboard/users', UserController::class);
      
      //   livewire routes
      Route::get('/dashboard/guidance/category', Guidancecategories::class)->name('guidance.category');
      Route::get('/dashboard/guidance-document/{cat_id}', Guidancedocumentcategories::class)->name('guidancedocument.category');
      Route::get('/dashboard/projectprograms/category', Programprojectcategories::class)->name('projectprogram.category');
      
      Route::get('/dashboard/climate-science-research/category', Csrcategories::class)->name('climatescience.research.category');
      Route::get('/dashboard/climate-science-research/category/{cat_id}', Csrsubcategories::class)->name('climatescience.research.subcategory');

      Route::get('/dashboard/sectors', Sectors::class)->name('sectors');
      // Route::get('/dashboard/forum-category', Forumcategories::class)->name('forum.category');
      Route::get('/dashboard/stations', Stations::class)->name('stations');
      Route::get('/dashboard/grids', Grids::class)->name('grids');
      Route::get('/dashboard/station/types', StationTypes::class)->name('station.types');
      Route::get('/dashboard/disaster/types', DisasterTypes::class)->name('disaster.types');
      Route::get('/dashboard/disaster/parameters', DisasterParameters::class)->name('disaster.parameters');

      Route::get('/dashboard/climate-models', ClimateModels::class)->name('climate-models');
      Route::get('/dashboard/climate-scenerios', ClimateScenerios::class)->name('climate-scenerios');
      Route::get('/dashboard/parameters', Parameters::class)->name('parameters');
      Route::get('/dashboard/statistics', Statistics::class)->name('statistics');

      Route::get('/dashboard/abouts', Abouts::class)->name('about');
      Route::get('/dashboard/link/category', Linkcategories::class)->name('link.category');
      Route::get('/dashboard/links/{link_id}', Links::class)->name('links');
      Route::get('/dashboard/media-gallery', Medias::class)->name('medias');
    });

    /*---------------------------------------------------------------------------------------
    | Group route for agency user panel 
    |----------------------------------------------------------------------------------------
    */
    Route::prefix('agency')->middleware('auth','hasRole:agency')->name('agency.')->group(function(){
      Route::get('/dashboard', [AgencyController::class, 'dashboard'])->name('dashboard');
      Route::get('/dashboard/research-publication/{catID}', Climatescienceresearchs::class)->name('climate.science.research');
      Route::resource('/dashboard/programprojects', ProgramprojectController::class);
      Route::resource('/dashboard/trainingmaterial', TrainingmaterialController::class);
      Route::resource('/dashboard/researchstudy', ResearchstudyController::class);

      Route::get('/dashboard/faqs', Faqs::class)->name('faqs');
      Route::get('/dashboard/posts/{postype}', Posts::class)->name('posts');
      Route::get('/dashboard/events', Events::class)->name('events');
      Route::get('/dashboard/experts', Experts::class)->name('experts');
      Route::get('/dashboard/guidance-document/{catID}', Guidancedocuments::class)->name('guidance.document');
      // Route::get('/dashboard/forum-post', Forums::class)->name('forum.index');

      //Data
      Route::get('/dashboard/climate/observed-data', ClimateObservedDatas::class)->name('climate.observed.data');
      Route::post('/dashboard/climate/observed/excel-import', [ClimateObservedDatas::class, 'climateExcelImport'])->name('climate.observed.xls.import');

      Route::get('/dashboard/climate/projected-data', ClimateProjectedDatas::class)->name('climate.projected.data');
      Route::post('/dashboard/climate/projected/excel-import', [ClimateProjectedDatas::class, 'climateExcelImport'])->name('climate.projected.xls.import');

      Route::get('/dashboard/climate/reanalyzed-data', ClimateReanalyzedDatas::class)->name('climate.reanalyzed.data');
      Route::post('/dashboard/climate/excel-import', [ClimateReanalyzedDatas::class, 'climateReanalyzedExcelImport'])->name('climate.reanalyzed.xls.import');

      Route::get('/dashboard/water/observed-data', WaterObservedDatas::class)->name('water.observed.data');
      Route::post('dashboard/water/observed/excel-import', [WaterObservedDatas::class, 'waterExcelImport'])->name('water.observed.xls.import');

      Route::get('/dashboard/water/projected-data', WaterProjectedDatas::class)->name('water.projected.data');
      Route::post('dashboard/water/projected/excel-import', [WaterProjectedDatas::class, 'waterExcelImport'])->name('water.projected.xls.import');


      Route::get('/dashboard/ghg-data', GreenhouseGases::class)->name('ghg.data');
      Route::post('/dashboard/ghg/excel-import', [GreenhouseGases::class, 'ghgExcelImport'])->name('ghg.xls.import');


      Route::get('/dashboard/disaster-data', DisasterDatas::class)->name('disaster.data');
      Route::get('/dashboard/disaster-impacts/{disaster}', DisasterImpacts::class)->name('disaster.impact');
      Route::post('/dashboard/disaster/excel-import', [DisasterDatas::class, 'disasterExcelImport'])->name('disaster.xls.import');
      Route::post('/dashboard/disaster/impact/excel-import', [DisasterImpacts::class, 'disasterImpactExcelImport'])->name('disaster.impact.xls.import');

      Route::get('/dashboard/timeframes', TimeFrames::class)->name('timeframes');
    });

    /*---------------------------------------------------------------------------------------
    | Group route for forum users - self registration using email verification 
    |----------------------------------------------------------------------------------------
    */
    // Route::prefix('forum')->middleware('auth','verified','hasRole:forum')->name('forum.')->group(function(){
    //   Route::get('/dashboard', [ForumController::class, 'dashboard'])->name('dashboard');
    //   Route::get('/dashboard/post', Forums::class)->name('forum.index');

    // });


