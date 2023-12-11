<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Survey;
use App\Models\Researcher;
use App\Models\PhoneRepeat;
use App\Models\TeacherInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repos\ImageRepository;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

        if (auth()->user()->valid) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {

                $response['errors'] = $validator->errors();
                return response()->json($response, 401);
            }



            $survey = $request->all();


            $survey['image_national_card_front'] = $this->parse_image($survey['image_national_card_front'] ?? null, "{$survey['name']}_ image_national_card_front");
            $survey['image_national_card_back'] = $this->parse_image($survey['image_national_card_back'] ?? null, "{$survey['name']}_ image_national_card_back");
            $survey['image_attend'] = $this->parse_image($survey['image_attend'] ?? null, "{$survey['name']}_ image_attend");
            $survey['image_contract_direct_work'] = $this->parse_image($survey['image_contract_direct_work'] ?? null, "{$survey['name']}_ image_contract_direct_work");



            // $survey['image_contract_direct_work'] =

            // return response($survey);
            // return response(base64_encode(file_get_contents('/home/ala/Documents/Projects/php/softupgrate/survey system/survey-teacher-laravel/storage/app/public/1cbfac69e28183f40e110017ab3f1e52.jpg')));
            // decode images base64
            // $survey['image_national_card_front'] = $request->image_national_card_front? $this->upload_image_base64($request->image_national_card_front, ''): null;
            // $survey['image_national_card_back'] = $request->image_national_card_back? $this->upload_image_base64($request->image_national_card_back, ''): null;
            // $survey['image_attend'] = $request->image_attend ? $this->upload_image_base64($request->image_attend, '') : null;
            // $survey['image_contract_direct_work'] = $request->image_contract_direct_work ? $this->upload_image_base64($request->image_contract_direct_work, '') : null;




            // ##########################

            // cheack repeated phone
            if ($phoneRepeat = PhoneRepeat::where('phone', $request->phone)->first()) {

                $phoneRepeat->update(['repeated' => $phoneRepeat->repeated + 1]);
            } else {
                PhoneRepeat::create([
                    'phone' => $request->phone,
                ]);
            }

            // if national_card_id is not exist
            $teacherInfo = TeacherInfo::where('national_card_id', $request->national_card_id)->first();
            if (!$teacherInfo) {
                if ($teacher = TeacherInfo::where('phone', $request->phone)->first()) {

                    $teacher->update(['changed_national_card_id' => $request->national_card_id]);
                    // return response($teacher);

                }
            }

            // if phone is not exist
            $teacherInfo = TeacherInfo::where('phone', $request->phone)->first();
            if (!$teacherInfo) {

                if ($teacher = TeacherInfo::where('national_card_id', $request->national_card_id)->first()) {
                    $teacher->update(['changed_phone' => $request->phone]);
                    // return response($teacher);
                }
            }


            $survey['researcher_id'] = auth()->user()->id;
            $surveySaved = Survey::create($survey);

            $response['success'] = [
                'saved'
            ];
            return response($response);
        }
        $response['errors'] = 'Please validate your account';
        return response()->json($response, 401);
    }


    public function getProfile()
    {
        $response['profile'] = [
            'token' => auth()->user()->getRememberToken(),
            'researcher' => auth()->user(),
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

    public function parse_image($image, $name)
    {
        if ($image) {
            $time = time();
            $imageName = "{$name}_{$time}.{$image->extension()}";
            $image->storeAs('public', $imageName);

            return  $imageName;
        }
        return  null;
    }

    public function upload_image_base64($base64_image, $image_path)
    {
        //The base64 encoded image data
        $image_64 = $base64_image;
        if (str_contains($image_64, ';base64,')) {
            // exploed the image to get the extension
            $extension = explode(';base64,', $image_64);
            //from the first element
            $extension = explode('/', $extension[0]);
            // from the 2nd element
            $extension = $extension[1];
            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
            $image = str_replace($replace, '', $image_64);
        } else {
            $extension = 'jpg';
            $image = $image_64;
        }
        // finding the substring from
        // dd($replace);
        // replace here for example in our case: data:image/png;base64,
        // replace
        // $base64_image = str_replace(' ', '+', $base64_image);
        // set the image name using the time and a random string plus
        // an extension
        $imageName = time() . '_' . Str::random(20) . '.' . $extension;
        // save the image in the image path we passed from the
        // function parameter.
        // if(base64_decode($image, $strict = true))
        // {
        dd($base64_image);
        Storage::disk('public')->put($imageName, base64_decode($base64_image));
        // return the image path and feed to the function that requests it
        // return $image_path . '/'. $imageName;
        return  $imageName;

        // }
        // return  null;

    }
}
