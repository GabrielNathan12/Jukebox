<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AuthenticationController extends Controller
{
    //
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
    
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'User registered'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error registering user: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function verify(){
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();
            return response()->json(['message' => 'Token válido', 'user' => $user], 200);
        } else {
            return response()->json(['message' => 'Token inválido'], 401);
        }
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $user = User::where("email", $request->email)->first();

        if(!empty($user)){
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken("token")->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "User logged",
                    "token" => $token,
                    "user" => $user
                ]);
            }
            else{
                return response()->json([
                    "status" => false,
                    "message" => "Invalid password"
                ]);
            }
        }
        else{
            return response()->json([
                "status" => false,
                "message" => "Please pass email and password"
            ]);
        }
    }

    public function profile(Request $request){
        $user = auth()->user();
        
        return response()->json([
            "status" => true,
            "message" => "Profile Info",
            "data" => $user
        ]);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return response()->json([
            "status" => true,
            "message" => "User logout"
        ]
        );

    }
}
