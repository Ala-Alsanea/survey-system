<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Researcher;
use App\Models\TeacherInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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
            'phone' => ['required', 'min:9', 'string', Rule::exists('researchers', 'phone')],
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

            $response['errors'] = ['The provided credentials are incorrect.'];
            return response()->json($response);
        }

        $response['success'] = [
            'token' => $researcher->createToken('mobile', ['role:researcher'])->plainTextToken,
            'researcher' => $researcher,
        ];
        return response($response);

        // return response(['password'=>Hash::make('password')]);


    }

    public function signin(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [

            'name' => 'required|string',
            'phone' => ['required','min:9', 'string'],
            'password' => 'required|string',
        ]);

        $response = [
            'success' => null,
            'errors' => null
        ];

        if ($validator->fails()) {
            $response['errors'] = $validator->errors()->toArray();
            return response()->json($response);
        }

        if(Researcher::where('phone', $request->phone)->pluck('phone')->all())
        {
            $response['errors'] = ['already signin'];
            return response()->json($response);
        }


        $researcher  =[];
        $researcher['name']= $request->name;
        $researcher['phone']= $request->phone;
        $researcher['password' ]= $request->password;

        $user = Researcher::create($researcher);
        // dd($user);

        // check if exist


        $response['success'] = [
            'token' => $user->createToken('mobile', ['role:researcher'])->plainTextToken,
            'researcher' => $user,
        ];
        return response($response);

        // return response(['password'=>Hash::make('password')]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //    $survay = $this->reformat($request->all());
        $survay = $request;
        $phone = TeacherInfo::where('phone', $survay->phone)->get()->all();
        return response($phone);
    }

    protected function  reformat($request)
    {

        $request = (array) $request;
        $request = array_map(fn ($val) => $val !== null? gettype(strval($val)):null , $request);
        // dd(new Request($request ));
        return new Request($request);

    }
}
