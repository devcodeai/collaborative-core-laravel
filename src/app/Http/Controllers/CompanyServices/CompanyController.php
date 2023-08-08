<?php

namespace App\Http\Controllers\CompanyServices;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function getCompanies()
    {
        $companies = Company::all();
        if ($companies->count() > 0) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Companies Success',
                'data' => $companies,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Companies Not Found',
        ], 404);
    }

    public function getCompanyById(int $id)
    {
        $company = Company::find($id);
        if ($company) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Company with ID ' . $id . ' Success',
                'data' => $company,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Company with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function createCompany(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $company = Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        if ($company) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Create Company Success',
                'data' => $company,
            ], 200); 
        }

        return response()->json([
            'status' => 'Failed',
            'message' => 'Internal Server Error',
        ], 500); 
    }

    public function updateCompanyById(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $company = Company::find($id);        
        if ($company) {
            $company->update([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Update Company with ID ' . $id . ' Success',
                'data' => [
                    'id' => $id,
                    'name' => $request->name,
                    'address' => $request->address,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Company with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function deleteCompanyById(int $id)
    {
        $company = Company::find($id);  
        if ($company) {
            $company->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Delete Company with ID ' . $id . ' Success',
                'data' => json_decode('{}')
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Company with ID ' . $id . ' Not Found',
        ], 404);
    }
}
