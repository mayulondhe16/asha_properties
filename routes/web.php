<?php
/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AboutusController;
use App\Http\Controllers\Admin\ContactdetailsController;
use App\Http\Controllers\Admin\QuicklinksController;
use App\Http\Controllers\Admin\SocialmedialinksController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\FeaturesController;
use App\Http\Controllers\Admin\AminitiesController;
use App\Http\Controllers\Admin\CompanyContactController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CountController;

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

// Route::get('/', function () {
//     return view('dashboard');
// });
// 
// Route::get('/', 									'Admin\AuthController@login');
Route::get('/', [AuthController::class, 'login']);
Route::post('/login_process', [AuthController::class, 'login_process']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::group(['middleware' => 'admin'], function () 
{
    Route::get('/dashbord',		 					[AuthController::class, 'dashbord']);
	Route::get('/manage_aboutus',		 			[AboutusController::class, 'index']);
	Route::get('/add_aboutus',		 				[AboutusController::class, 'add']);
	Route::post('/store_aboutus',		 			[AboutusController::class, 'store']);
	Route::get('/view_aboutus/{id}',	 			[AboutusController::class, 'view']);
	Route::get('/edit_aboutus/{id}',		 		[AboutusController::class, 'edit']);
	Route::post('/update_aboutus/{id}',		 		[AboutusController::class, 'update']);
	Route::get('/delete_aboutus/{id}',		 		[AboutusController::class, 'delete']);

	Route::get('/manage_contactdetails',		 			[CompanyContactController::class, 'index']);
	Route::get('/add_contactdetails',		 				[CompanyContactController::class, 'add']);
	Route::post('/store_contactdetails',		 			[CompanyContactController::class, 'store']);
	Route::get('/view_contactdetails/{id}',	 				[CompanyContactController::class, 'view']);
	Route::get('/edit_contactdetails/{id}',		 			[CompanyContactController::class, 'edit']);
	Route::post('/update_contactdetails/{id}',		 		[CompanyContactController::class, 'update']);
	Route::get('/delete_contactdetails/{id}',		 		[CompanyContactController::class, 'delete']);

	Route::get('/manage_quicklinks',		 			[QuicklinksController::class, 'index']);
	Route::get('/add_quicklinks',		 				[QuicklinksController::class, 'add']);
	Route::post('/store_quicklinks',		 			[QuicklinksController::class, 'store']);
	Route::get('/view_quicklinks/{id}',	 				[QuicklinksController::class, 'view']);
	Route::get('/edit_quicklinks/{id}',		 			[QuicklinksController::class, 'edit']);
	Route::post('/update_quicklinks/{id}',		 		[QuicklinksController::class, 'update']);
	Route::get('/delete_quicklinks/{id}',		 		[QuicklinksController::class, 'delete']);

	Route::get('/manage_socialmedialinks',		 			[SocialmedialinksController::class, 'index']);
	Route::get('/add_socialmedialinks',		 				[SocialmedialinksController::class, 'add']);
	Route::post('/store_socialmedialinks',		 			[SocialmedialinksController::class, 'store']);
	Route::get('/view_socialmedialinks/{id}',	 			[SocialmedialinksController::class, 'view']);
	Route::get('/edit_socialmedialinks/{id}',		 		[SocialmedialinksController::class, 'edit']);
	Route::post('/update_socialmedialinks/{id}',		 	[SocialmedialinksController::class, 'update']);
	Route::get('/delete_socialmedialinks/{id}',		 		[SocialmedialinksController::class, 'delete']);

	Route::get('/manage_newsletter',		 			[NewsletterController::class, 'index']);
	Route::get('/manage_property_type',		 			[PropertyTypeController::class, 'index']);
	Route::get('/add_property_type',		 				[PropertyTypeController::class, 'add']);
	Route::post('/store_property_type',		 			[PropertyTypeController::class, 'store']);
	Route::get('/view_property_type/{id}',	 			[PropertyTypeController::class, 'view']);
	Route::get('/edit_property_type/{id}',		 		[PropertyTypeController::class, 'edit']);
	Route::post('/update_property_type/{id}',		 	[PropertyTypeController::class, 'update']);
	Route::get('/delete_property_type/{id}',		 		[PropertyTypeController::class, 'delete']);

	Route::get('/manage_review',		 			[ReviewController::class, 'index']);
	Route::get('/add_review',		 				[ReviewController::class, 'add']);
	Route::post('/store_review',		 			[ReviewController::class, 'store']);
	Route::get('/view_review/{id}',	 			[ReviewController::class, 'view']);
	Route::get('/edit_review/{id}',		 		[ReviewController::class, 'edit']);
	Route::post('/update_review/{id}',		 	[ReviewController::class, 'update']);
	Route::get('/delete_review/{id}',		 		[ReviewController::class, 'delete']);


	Route::get('/manage_projects',		 			[ProjectsController::class, 'index']);
	Route::get('/add_projects',		 				[ProjectsController::class, 'add']);
	Route::post('/store_projects',		 			[ProjectsController::class, 'store']);
	Route::get('/view_projects/{id}',	 			[ProjectsController::class, 'view']);
	Route::get('/edit_projects/{id}',		 		[ProjectsController::class, 'edit']);
	Route::post('/update_projects/{id}',		 	[ProjectsController::class, 'update']);
	Route::get('/delete_projects/{id}',		 		[ProjectsController::class, 'delete']);
	Route::get('/change_status/{id}',	 	    	[ProjectsController::class, 'change_status']);

	
	Route::get('/manage_layouts',		 			[ProjectsController::class, 'manage_layouts']);
	Route::get('/add_sub_layouts/{id}',		 		[ProjectsController::class, 'add_sublayouts']);
	Route::post('/store_sublayouts',		 	    [ProjectsController::class, 'store_sublayouts']);


	Route::get('/manage_counts',		 			[CountController::class, 'index']);
	Route::get('/add_counts',		 				[CountController::class, 'add']);
	Route::post('/store_counts',		 			[CountController::class, 'store']);
	Route::get('/view_counts/{id}',	 			[CountController::class, 'view']);
	Route::get('/edit_counts/{id}',		 		[CountController::class, 'edit']);
	Route::post('/update_counts/{id}',		 	[CountController::class, 'update']);
	Route::get('/delete_counts/{id}',		 		[CountController::class, 'delete']);
});
Route::get('/foo', function () {
    Artisan::call('storage:link');
});
