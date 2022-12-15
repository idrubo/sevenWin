<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;
use Validator;
use App\Models\Player;

class authC extends Controller
{
  public function register (Request $request)
  {
    if (empty ($request ['name'])) $request ['name'] = 'anonymous';

    $post = $request->only (['name', 'email', 'password', 'role']);

    $rules = [
      'name'     => 'required|string|min:4',
      'email'    => 'required|email',
      'password' => 'required|min:8',
      'role'     => 'in:player,admin',
    ];

    $valid = Validator::make ($post, $rules);

    if ($valid->fails ()) {
      return response ()->json ([
        'success' => false,
        'message' => 'Data not validated.',
        'errors'  => $valid->errors ()
      ], 400);
    }

    Player::create ($request);

    return response ()->json ([ 'message' => 'Player successfully created.' ], 201);
  }

  public function login (Request $request)
  {
    $post = $request->only (['email', 'password']);

    $rules = [
      'email'    => 'required|email',
      'password' => 'required|min:8',
    ];

    $valid = Validator::make ($post, $rules);

    if ($valid->fails ())
    {
      return response ()->json ([
        'success' => false,
        'message' => 'Data not validated.',
        'errors' => $valid->errors()
      ], 400);
    }

    if (auth ()->attempt ($post))
    {
      $token = auth ()->user ()->createToken ('passport_token')->accessToken;

      return response ()->json ([
        'success' => true,
        'message' => 'Player logged in succesfully, use token to authenticate.',
        'token' => $token
      ], 200);
    }
    else
    {
      return response()->json([
        'success' => false,
        'message' => 'Player authentication failed.'
      ], 401);
    }
  }

  public function logout ()
  {
    $access_token = Auth::user ()->token ();

    $tokenRepository = app (TokenRepository::class);
    $tokenRepository->revokeAccessToken ($access_token->id);

    return response ()->json ([
      'success' => true,
      'message' => 'User logged out.'
    ], 200);
  }
}

