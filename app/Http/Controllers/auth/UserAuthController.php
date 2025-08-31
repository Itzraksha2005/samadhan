<?php

namespace App\Http\Controllers\auth;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;

use App\Models\Register;

class UserAuthController extends Controller
{
    
    public function register(Request $request){
        $validatedData=$request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255',
            'password'=>'required|string|min:6',
        ]); 
        $data=Register::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
             $token=auth('user')->login($data);
             return $this->respondWithToken($token);

    }
    public function login()
    {
        $credentials = request(['email', 'password']);

        //return $credentials;

        if (! $token = auth('user')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        
        return $this->respondWithToken($token);
    }

// this login function is only for debugging purpose
//     public function login(Request $request)
// {
//     $credentials = $request->only('email', 'password');

//     $user = Register::where('email', $credentials['email'])->first();

//     if (! $user) {
//         return response()->json(['error' => 'No user found with that email'], 404);
//     }

//     return response()->json([
//         'email_sent' => $credentials['email'],
//         'password_sent' => $credentials['password'],
//         'password_in_db' => $user->password,
//         'password_matches' => \Hash::check($credentials['password'], $user->password),
//         'auth_attempt' => auth('user')->attempt($credentials) ? 'success' : 'fail'
//     ]);
// }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('user')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('user')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('user')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('user')->factory()->getTTL() * 60
        ]);
    }
}