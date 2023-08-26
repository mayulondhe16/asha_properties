<?php
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiController;
 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/get_aboutus',		 			[ApiController::class, 'get_aboutus']);
Route::get('/get_contactDetails',		 			[ApiController::class, 'get_contactDetails']);
Route::get('/get_properties',		 			[ApiController::class, 'get_properties']);
Route::get('/get_projects',		 			[ApiController::class, 'get_projects']);
Route::get('/get_done_projects',		 			[ApiController::class, 'get_done_projects']);
Route::get('/get_ongoing_projects',		 			[ApiController::class, 'get_ongoing_projects']);
Route::post('/add_contact_us',		 			[ApiController::class, 'add_contact_us']);
Route::get('/get_counts',		 			[ApiController::class, 'get_counts']);
Route::get('/get_socialmedialinks',		 			[ApiController::class, 'get_socialmedialinks']);
Route::get('/get_reviews',		 			[ApiController::class, 'get_reviews']);
Route::get('/get_amenities/{id}',		 			[ApiController::class, 'get_amenities']);
Route::get('/get_project_details/{id}',		 			[ApiController::class, 'get_project_details']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 
Route::group([
 
    'middleware' => 'api',
    'prefix' => 'auth'
 
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
});