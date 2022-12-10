<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Player;

class playerC extends Controller
{
  public function modifyPlayer (Request $request, $id)
  {
    $post = $request->only (['name']);

    $rules = [
      'name'     => 'required|string|min:4',
    ];

    $valid = Validator::make ($post, $rules);

    if ($valid->fails ()) {
      return response ()->json ([
        'success' => false,
        'message' => 'Data not validated.',
        'errors'  => $valid->errors ()
      ], 400);
    }

    $authPlayer = request ()->user ();

    if ($authPlayer->id == $id)
    {
      Player::modify ($request ['name'], $id);
      return response ()->json ([
        'success' => true,
        'message' => 'Player name modified.'
      ], 200);
    }
    else
    {
      return response ()->json ([
        'success' => false,
        'message' => 'Unauthenticated, player name NOT modified.'
      ], 401);
    }
  }
}

