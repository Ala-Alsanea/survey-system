<?php

namespace App\Http\Controllers;

use App\Models\PhoneRepeat;
use Validator;
use App\Models\Researcher;
use App\Models\Survey;
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
            'phone' => ['required', 'min:9', 'max:9', 'string'],
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

        if (Researcher::where('phone', $request->phone)->pluck('phone')->all()) {
            $response['errors'] = ['already signin'];
            return response()->json($response);
        }


        $researcher  = [];
        $researcher['name'] = $request->name;
        $researcher['phone'] = $request->phone;
        $researcher['password'] = $request->password;

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
    public function storeSurvey(Request $request)
    {
        $response = [
            'success' => null,
            'errors' => null
        ];

        if ($phoneRepeat = PhoneRepeat::where('phone', $request->phone)->first()) {

            $phoneRepeat->update(['repeated' => $phoneRepeat->repeated + 1]);
        } else {
            PhoneRepeat::create([
                'phone' => $request->phone,
            ]);
        }
        // if phone is not exist
        $teacherInfo = TeacherInfo::where('national_card_id', $request->national_card_id)->first();
        if (!$teacherInfo) {
            if ($teacher = TeacherInfo::where('phone', $request->phone)->first()) {

                $teacher->update(['changed_national_card_id'=> $request->national_card_id]);
                // return response($teacher);

            }
        }

        $teacherInfo = TeacherInfo::where('phone', $request->phone)->first();
        if (!$teacherInfo) {

            if ($teacher = TeacherInfo::where('national_card_id', $request->national_card_id)->first()) {
                $teacher->update(['changed_phone'=> $request->phone]);
                // return response($teacher);
            }
        }


        // if phone is exist


        // $survey = $request->all();


        $surveySaved = Survey::create($request->all());

        $response['success'] = [
            'saved'
        ];
        return response($response);
    }

    protected function  reformat($request)
    {

        $request = (array) $request;
        $request = array_map(fn ($val) => $val !== null ? gettype(strval($val)) : null, $request);
        // dd(new Request($request ));
        return new Request($request);
    }

    public function getProfile()
    {
        $response['profile'] = [
            'token' => auth()->user()->getRememberToken(),
            'researcher' => auth()->user(),
        ];
        return response($response);
    }
}
