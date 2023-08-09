<?php

namespace App\Http\Controllers\CampusServices;

use App\Models\Major;
use App\Models\Campus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    public function getMajorsByCampusId(Request $request)
    {
        $campus_id = $request->query('campus_id');
        $majors = Major::where('campus_id', $campus_id)->get();
        if ($majors->count() > 0) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Majors with Campus ID ' . $campus_id . ' Success',
                'data' => $majors,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Majors with Campus ID ' . $campus_id . ' Not Found',
        ], 404);

        
    }

    public function getMajorById(int $id)
    {
        $major = Major::find($id);
        if ($major) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Major with ID ' . $id . ' Success',
                'data' => $major,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Major with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function createMajorByCampusId(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'campus_id' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $campus = Campus::find($request->campus_id);
        if (!$campus) {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Create Major Failed, Campus with ID ' . $request->campus_id . ' Not Found',
            ], 404);
        }

        $major = Major::create([
            'name' => $request->name,
            'campus_id' => $request->campus_id,
        ]);
        if ($major) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Create Major Success',
                'data' => $major,
            ], 200); 
        }

        return response()->json([
            'status' => 'Failed',
            'message' => 'Internal Server Error',
        ], 500); 
    }

    public function updateMajorById(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'campus_id' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $campus = Campus::find($request->campus_id);
        if (!$campus) {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Update Major Failed, Campus with ID ' . $request->campus_id . ' Not Found',
            ], 404);
        }

        $major = Major::find($id);        
        if ($major) {
            $major->update([
                'name' => $request->name,
                'campus_id' => $request->campus_id,
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Update Major with ID ' . $id . ' Success',
                'data' => [
                    'id' => $id,
                    'name' => $request->name,
                    'campus_id' => $request->campus_id,
                ]
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Major with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function deleteMajorById(int $id)
    {
        $major = Major::find($id);  
        if ($major) {
            $major->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Delete Major with ID ' . $id . ' Success',
                'data' => json_decode('{}')
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Major with ID ' . $id . ' Not Found',
        ], 404);
    }
}
