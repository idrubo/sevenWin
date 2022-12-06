<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Player;

class playerC extends Controller
{
  public function modifyPlayer (Request $request, $id)
  {
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

