<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TalentServices\TalentController;
use App\Http\Controllers\CompanyServices\CompanyController;
use App\Http\Controllers\CompanyServices\ProductController;

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
// > Major Routes
// Talent Services
// > Talent Routes
Route::get('talents', [TalentController::class, 'getTalents']);
Route::get('talents/{id}', [TalentController::class, 'getTalentById']);
Route::post('talents', [TalentController::class, 'createTalent']);
Route::put('talents/{id}', [TalentController::class, 'updateTalentById']);
Route::delete('talents/{id}', [TalentController::class, 'deleteTalentById']);
// Community Services
// > Community Routes
