<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TalentServices\TalentController;
use App\Http\Controllers\CommunityServices\CommunityController;
use App\Http\Controllers\CompanyServices\CompanyController;
use App\Http\Controllers\CompanyServices\ProductController;
use App\Http\Controllers\CampusServices\CampusController;
use App\Http\Controllers\CampusServices\MajorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Company Services
// > Company Routes
Route::get('companies', [CompanyController::class, 'getCompanies']);
Route::get('companies/{id}', [CompanyController::class, 'getCompanyById']);
Route::post('companies', [CompanyController::class, 'createCompany']);
Route::put('companies/{id}', [CompanyController::class, 'updateCompanyById']);
Route::delete('companies/{id}', [CompanyController::class, 'deleteCompanyById']);
// > Product Routes
Route::get('products', [ProductController::class, 'getProductsByCompanyId']);
Route::get('products/{id}', [ProductController::class, 'getProductById']);
Route::post('products', [ProductController::class, 'createProductByCompanyId']);
Route::put('products/{id}', [ProductController::class, 'updateProductById']);
Route::delete('products/{id}', [ProductController::class, 'deleteProductById']);

// Campus Services
// > Campus Routes
Route::get('campuses', [CampusController::class, 'getCampuses']);
Route::get('campuses/{id}', [CampusController::class, 'getCampusById']);
Route::post('campuses', [CampusController::class, 'createCampus']);
Route::put('campuses/{id}', [CampusController::class, 'updateCampusById']);
Route::delete('campuses/{id}', [CampusController::class, 'deleteCampusById']);
// > Major Routes
Route::get('majors', [MajorController::class, 'getMajorsByCampusId']);
Route::get('majors/{id}', [MajorController::class, 'getMajorById']);
Route::post('majors', [MajorController::class, 'createMajorByCampusId']);
Route::put('majors/{id}', [MajorController::class, 'updateMajorById']);
Route::delete('majors/{id}', [MajorController::class, 'deleteMajorById']);

// Talent Services
// > Talent Routes
Route::get('talents', [TalentController::class, 'getTalents']);
Route::get('talents/{id}', [TalentController::class, 'getTalentById']);
Route::post('talents', [TalentController::class, 'createTalent']);
Route::put('talents/{id}', [TalentController::class, 'updateTalentById']);
Route::delete('talents/{id}', [TalentController::class, 'deleteTalentById']);

// Community Services
// > Community Routes
Route::get('communities', [CommunityController::class, 'getCommunities']);
Route::get('communities/{id}', [CommunityController::class, 'getCommunityById']);
Route::post('communities', [CommunityController::class, 'createCommunity']);
Route::put('communities/{id}', [CommunityController::class, 'updateCommunityById']);
Route::delete('communities/{id}', [CommunityController::class, 'deleteCommunityById']);
