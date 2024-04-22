<?php

use App\Http\Controllers\BusinessTypeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\IndustryTypeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadForController;
use App\Http\Controllers\LeadNoteController;
use App\Http\Controllers\LeadSourceController;
use App\Http\Controllers\LeadStatusController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;



route::get('logout',[loginController::class,'logout'])->name('logout');

Route::get('forgot-password', [ForgotPasswordController::class, 'index']);
Route::post('forgot-password', [ForgotPasswordController::class, 'checkUser']);
Route::get('forgot-password/{token}', [ForgotPasswordController::class, 'generatepassword']);
Route::post('forgot-password/{token}', [ForgotPasswordController::class, 'passwordUpdate']);

// Route::get('change-password', [ForgotPasswoardController::class, 'index']);
// Route::post('change-password', [ForgotPasswordController::class, 'checkUser']);
// Route::get('change-password/{token}', [ForgotPasswordController::class, 'generatepassword']);
// Route::post('change-password/{token}', [ForgotPasswordController::class, 'passwordUpdate']);



Route::middleware(['auth'])->group(function () { 
  

Route::get('home', [DashboardController::class, 'index']); 




Route::any('contacts/delete/{id}', [ContactController::class, 'destroy']);  
Route::get('user/delete/{id?}', [UserController::class, 'delete']); 
Route::get('countries/delete/{id}', [CountryController::class, 'delete']);
Route::get('states/delete/{id?}', [StateController::class, 'delete']);
Route::get('cities/delete/{id}', [CityController::class, 'delete']); 
Route::get('lead_status/delete/{id}', [LeadStatusController::class, 'delete']);
Route::get('lead_source/delete/{id}', [LeadSourceController::class, 'delete']); 
Route::get('lead_for/delete/{id}', [LeadForController::class, 'delete']); 
Route::get('industry-type/delete/{id}', [IndustryTypeController::class, 'delete']); 
Route::get('business-type/delete/{id}', [BusinessTypeController::class, 'delete']); 


Route::get('contacts', [ContactController::class, 'index']); 
Route::get('contacts/add/{id?}', [ContactController::class, 'add']); 
Route::post('contacts/mange-filltering',[ContactController::class,'contactFillter']);
Route::post('contacts/save', [ContactController::class, 'save']);  



Route::get('leads', [LeadController::class, 'index']); 
Route::get('leads/add/{id?}', [LeadController::class, 'add']); 
Route::get('leads/view/{id}', [LeadController::class, 'view']); 
Route::post('leads/save', [LeadController::class, 'save']);
Route::any('leads/filter', [LeadController::class, 'leadFilter']);

Route::post('leadnote/view/save', [LeadNoteController::class, 'save']);
Route::get('leadnote/delete/{id}', [LeadNoteController::class, 'destroy']);
Route::post('leadnote/delete/{id}', [LeadNoteController::class, 'destroy']);


Route::get('party', [PartyController::class, 'index']); 
Route::get('party/add/{id?}', [PartyController::class, 'add']); 
Route::get('party/view/{id}', [PartyController::class, 'view']); 
Route::post('party/save', [PartyController::class, 'save']);
Route::any('party/filter', [PartyController::class, 'PartyFilter']);

Route::get('user/{id?}', [UserController::class, 'add']); 
Route::post('user/save', [UserController::class, 'save']); 


Route::get('master', [MasterController::class, 'index']); 

Route::get('countries/add/{id?}', [CountryController::class, 'add']); 
Route::post('countries/save', [CountryController::class, 'save']);
 

Route::get('states/add/{id?}', [StateController::class, 'add']); 
Route::post('states/save', [StateController::class, 'save']);
 

Route::get('cities/add/{id?}', [CityController::class, 'add']); 
Route::post('cities/save', [CityController::class, 'save']);


Route::get('lead_status/add/{id?}', [LeadStatusController::class, 'add']); 
Route::post('lead_status/save', [LeadStatusController::class, 'save']);
 


Route::get('lead_source/add/{id?}', [LeadSourceController::class, 'add']); 
Route::post('lead_source/save', [LeadSourceController::class, 'save']);

Route::get('lead_for/add/{id?}', [LeadForController::class, 'add']); 
Route::post('lead_for/save', [LeadForController::class, 'save']);


Route::get('industry-type/add/{id?}', [IndustryTypeController::class, 'add']); 
Route::post('industry-type/save', [IndustryTypeController::class, 'save']);

Route::get('business-type/add/{id?}', [BusinessTypeController::class, 'add']); 
Route::post('business-type/save', [BusinessTypeController::class, 'save']);

});