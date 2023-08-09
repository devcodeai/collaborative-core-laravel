<?php

namespace App\Http\Controllers\CampusServices;

use App\Models\Campus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CampusController extends Controller
{
    public function getCampuses()
    {
        $campuses = Campus::all();
        if ($campuses->count() > 0) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Campuses Success',
                'data' => $campuses,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Campuses Not Found',
        ], 404);
    }

    public function getCampusById(int $id)
    {
        $campus = Campus::find($id);
        if ($campus) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Campus with ID ' . $id . ' Success',
                'data' => $campus,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Campus with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function createCampus(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'university_name' => 'required|string',
            'location' => 'required|string',
            'website' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $campus = Campus::create([
            'university_name' => $request->university_name,
            'location' => $request->location,
            'website' => $request->website
        ]);
        if ($campus) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Create Campus Success',
                'data' => $campus,
            ], 200); 
        }

        return response()->json([
            'status' => 'Failed',
            'message' => 'Internal Server Error',
        ], 500); 
    }

    public function updateCampusById(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'university_name' => 'required|string',
            'location' => 'required|string',
            'website' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $campus = Campus::find($id);        
        if ($campus) {
            $campus->update([
                'university_name' => $request->university_name,
                'location' => $request->location,
                'website' => $request->website
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Update Campus with ID ' . $id . ' Success',
                'data' => [
                    'id' => $id,
                    'university_name' => $request->university_name,
                    'location' => $request->location,
                    'website' => $request->website
                ]
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Campus with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function deleteCampusById(int $id)
    {
        $campus = Campus::find($id);  
        if ($campus) {
            $campus->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Delete Campus with ID ' . $id . ' Success',
                'data' => json_decode('{}')
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Campus with ID ' . $id . ' Not Found',
        ], 404);
    }
}
