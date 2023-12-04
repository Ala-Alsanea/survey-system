<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Researcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ResearcherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [

            // 'name' => 'required|string',
            'phone' => 'required|min:9',
            'password' => 'required|string',
        ]);

        $response = [
            'success' => null,
            'errors' => null
        ];

        // validate
        if ($validator->fails()) {
            $response['errors'] = $validator->errors()->toArray();
            return response()->json($response);
        }

        // check if exist
        $researcher = Researcher::where('phone', $request->phone)->first();

        if (!$researcher || !Hash::check($request->password, $researcher->password)) {

            $response['errors']=['The provided credentials are incorrect.'];
            return response()->json($response);

        }

        $response['success']= [
            'token'=>$researcher->createToken('mobile', ['role:researcher'])->plainTextToken,
            'researcher' => $researcher,
        ];
        return response($response);

        // return response(['password'=>Hash::make('password')]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return response(['test']);
    }
}
