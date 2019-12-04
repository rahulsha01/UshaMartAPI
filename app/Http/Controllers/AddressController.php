<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class AddressController extends Controller
{
    public $successStatus = 200;


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ad_u_id' => 'required',
            'ad_addressLine1' => 'required',
            'ad_addressLine2' => 'required',
            'ad_state' => 'required',
            'ad_city' => 'required',
            'ad_pincode' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

            $input = $request->all();
            $input['ad_id'] = Uuid::generate()->string;
            // dd($input);
            Address::insert($input);
            $success['msg'] = "Successfully Addded Address";
            return response()->json(['success' => $success], $this->successStatus);
    }
}
