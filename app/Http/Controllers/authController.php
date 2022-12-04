<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;
use Validator;
use App\Models\User;

/* DEBUG */
/* DEBUG */
/* DEBUG */
/*
 * 1.- Check the return values for the database operations.
 */
/* DEBUG */
/* DEBUG */
/* DEBUG */

class authController extends Controller
{
  public function register (Request $request)
  {
    $post = $request->only (['name', 'email', 'password', 'role']);

    $rules = [
      'name'     => 'required|string|min:4',
      'email'    => 'required|email',
      'password' => 'required|min:8',
      'role'     => 'in:player,guest',
    ];

    $valid = Validator::make ($post, $rules);

    if ($valid->fails ()) {
      return response ()->json ([
        'success' => false,
        'message' => 'Data not validated.',
        'errors'  => $valid->errors ()
      ], 400);
    }

    $status = User::savePlayer ($request);

    return response ()->json ([ 'message' => 'Player successfully created.' ], 201);
  }

  public function login (Request $request)
  {
    $request->validate ([
      'email'    => 'required|string|email',
      'password' => 'required|string',
    ]);

    $credentials = request (['email', 'password']);

    if (! Auth::attempt ($credentials))
      return response ()->json ([ 'message' => 'Unauthorized !!!' ], 401);

    $token = auth ()->user ()->createToken ('API Token')->accessToken;

    return response (['user' => auth ()->user (), 'token' => $token]);
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

