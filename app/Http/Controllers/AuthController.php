<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    //

    public function auth(Request $request)
    {
        $user = User::where('name', $request->name)->first();
        if (!$user && !Hash::check($request->password, $user->password)) {
          return response()->json([
            'message' => 'wrong user or password'
          ]);
    }
    $token = $user->createToken(Str::random(10))->plainTextToken;
    return response()->json([
      'status' => 'success',
      'is_user' => $user->isUser(),
      'token' => $token
    ], 201);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
          'message' => 'Successfully logged out'
        ]);
    }
}
