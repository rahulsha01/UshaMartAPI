<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Address;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            if($user->u_role == 2) {
                $success['token'] =  $user->createToken('MyApp', ['admin'])->accessToken;
                return response()->json(['success' => $success], $this->successStatus);
            }
            else if($user->u_role == 1) {
                $success['token'] =  $user->createToken('MyApp', ['user'])->accessToken;
                return response()->json(['success' => $success], $this->successStatus);
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'u_firstname' => 'required',
            'u_lastname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['u_firstname'] =  $user->u_firstname;
        return response()->json(['success' => $success], $this->successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    public function getUser()
    {
         $user = User::all();
         return response()->json(array(
             'data'=> $user
         ));
    }

    public function getUserAddress(Request $request)
    {
        $user = User::with(['addresses'])->where('u_id', $request->u_id)->get();
        return response()->json(array(
            'data' => $user,
            'statuscode'=> $this->successStatus
        ));
    }

    public function createRole()
    {
        //Role::create(['name'=> 'admin']);
        // Permission::create(['name'=> 'administrator']);
        // return response()->json(['msg' => 'Role created']);
        try {
            dd(DB::connection());
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
