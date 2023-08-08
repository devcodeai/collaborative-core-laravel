<?php

namespace App\Http\Controllers\TalentServices;

use App\Models\Talent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TalentController extends Controller
{
    public function getTalents()
    {
        $talents = Talent::all();
        if ($talents->count() > 0) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Talents Success',
                'data' => $talents,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Talents Not Found',
        ], 404);
    }

    public function getTalentById(int $id)
    {
        $talent = Talent::find($id);
        if ($talent) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Talent with ID ' . $id . ' Success',
                'data' => $talent,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Talent with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function createTalent(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'skills' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $talent = Talent::create([
            'name' => $request->name,
            'email' => $request->email,
            'skills' => $request->skills,
        ]);
        if ($talent) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Create Talent Success',
                'data' => $talent,
            ], 200); 
        }

        return response()->json([
            'status' => 'Failed',
            'message' => 'Internal Server Error',
        ], 500); 
    }

    public function updateTalentById(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'skills' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $talent = Talent::find($id);        
        if ($talent) {
            $talent->update([
                'name' => $request->name,
                'email' => $request->email,
                'skills' => $request->skills,
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Update Talent with ID ' . $id . ' Success',
                'data' => [
                    'id' => $id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'skills' => $request->skills,
                ]
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Talent with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function deleteTalentById(int $id)
    {
        $talent = Talent::find($id);  
        if ($talent) {
            $talent->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Delete Talent with ID ' . $id . ' Success',
                'data' => json_decode('{}')
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Talent with ID ' . $id . ' Not Found',
        ], 404);
    }
}
