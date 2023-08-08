<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyServices\CompanyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Company Services
// > Company Routes
Route::get('companies', [CompanyController::class, 'index']);
// > Product Routes
// Campus Services
// > Campus Routes
// > Major Routes
// Talent Services
// > Talent Routes
// Community Services
// > Community Routes
