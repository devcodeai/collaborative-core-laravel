<?php

namespace App\Http\Controllers\CompanyServices;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function getProductsByCompanyId(Request $request)
    {
        $company_id = $request->query('company_id');
        $products = Product::where('company_id', $company_id)->get();
        if ($products->count() > 0) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Products with Company ID ' . $company_id . ' Success',
                'data' => $products,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Products with Company ID ' . $company_id . ' Not Found',
        ], 404);
    }

    public function getProductById(int $id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Product with ID ' . $id . ' Success',
                'data' => $product,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Product with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function createProductByCompanyId(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'company_id' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $company = Company::find($request->company_id);
        if (!$company) {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Create Product Failed, Company with ID ' . $request->company_id . ' Not Found',
            ], 404);
        }

        $product = Product::create([
            'name' => $request->name,
            'company_id' => $request->company_id,
        ]);
        if ($product) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Create Product Success',
                'data' => $product,
            ], 200); 
        }

        return response()->json([
            'status' => 'Failed',
            'message' => 'Internal Server Error',
        ], 500); 
    }

    public function updateProductById(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'company_id' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $company = Company::find($request->company_id);
        if (!$company) {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Update Product Failed, Company with ID ' . $request->company_id . ' Not Found',
            ], 404);
        }

        $product = Product::find($id);        
        if ($product) {
            $product->update([
                'name' => $request->name,
                'company_id' => $request->company_id,
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Update Product with ID ' . $id . ' Success',
                'data' => [
                    'id' => $id,
                    'name' => $request->name,
                    'company_id' => $request->company_id,
                ]
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Product with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function deleteProductById(int $id)
    {
        $product = Product::find($id);  
        if ($product) {
            $product->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Delete Product with ID ' . $id . ' Success',
                'data' => json_decode('{}')
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Product with ID ' . $id . ' Not Found',
        ], 404);
    }
}
