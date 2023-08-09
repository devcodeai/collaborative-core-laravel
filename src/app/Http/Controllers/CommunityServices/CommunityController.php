<?php

namespace App\Http\Controllers\CommunityServices;

use App\Models\Community;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{
    public function getCommunities()
    {
        $communities = Community::all();
        if ($communities->count() > 0) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Communities Success',
                'data' => $communities,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Communities Not Found',
        ], 404);
    }

    public function getCommunityById(int $id)
    {
        $community = Community::find($id);
        if ($community) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Fetch Community with ID ' . $id . ' Success',
                'data' => $community,
            ], 200);
        }

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Community with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function createCommunity(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'members' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $community = Community::create([
            'name' => $request->name,
            'description' => $request->description,
            'members' => $request->members,
        ]);
        if ($community) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Create Community Success',
                'data' => $community,
            ], 200); 
        }

        return response()->json([
            'status' => 'Failed',
            'message' => 'Internal Server Error',
        ], 500); 
    }

    public function updateCommunityById(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'members' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Bad Request',
            ], 400); 
        }

        $community = Community::find($id);        
        if ($community) {
            $community->update([
                'name' => $request->name,
                'description' => $request->description,
                'members' => $request->members,
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Update Community with ID ' . $id . ' Success',
                'data' => [
                    'id' => $id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'members' => $request->members
                ]
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Community with ID ' . $id . ' Not Found',
        ], 404);
    }

    public function deleteCommunityById(int $id)
    {
        $community = Community::find($id);  
        if ($community) {
            $community->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Delete Community with ID ' . $id . ' Success',
                'data' => json_decode('{}')
            ], 200); 
        } 

        return response()->json([
            'status' => 'Not Found',
            'message' => 'Community with ID ' . $id . ' Not Found',
        ], 404);
    }
}
