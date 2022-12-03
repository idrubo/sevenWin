<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\TokenRepository;
use App\Models\User;

class authController extends Controller
{
  public function register (Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'email' => 'required|string|email|unique:users',
      'password' => 'required|string'
    ]);

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make ($request->password)
    ]);

    return response()->json([ 'message' => 'Successfully created user.' ], 201);
  }

  public function login (Request $request)
  {
    $request->validate ([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);

    $credentials = request (['email', 'password']);

    if (! Auth::attempt($credentials))
      return response()->json([ 'message' => 'Unauthorized !!!' ], 401);

    $token = auth ()->user ()->createToken ('API Token')->accessToken;

    return response (['user' => auth ()->user (), 'token' => $token]);
  }

  public function logout ()
  {
    $access_token = Auth::user ()->token ();

    $tokenRepository = app (TokenRepository::class);
    $tokenRepository->revokeAccessToken ($access_token->id);

    return response()->json([
      'success' => true,
      'message' => 'User logout successfully.'
    ], 200);
  }
}
