<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()){
            $response =[
                'sucess' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = $request->except('c_password');
        $imput['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('myapp')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' =>'User register successfully'
        ];
        return response()->json_encode($response,200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            // 'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()){
            $response =[
                'sucess' => false,
                'message' => $validator->errors()
            ];
            return response()->json($esponse, 400);
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $requet->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('myapp')->plainTextToken;
            $success['name'] = $user->name;

            $response = [
                'success' => true,
                'data' => $success,
                'message' =>'User login successfully'
            ];
            return response()->json_encode($response,200);
        }else{
            $response = [
                'success' => false,
                'message' =>'Unauthorized'
            ];
            return response()->json_encode($response);
        };
    }
}
