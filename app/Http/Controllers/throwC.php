<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\ThrowDice;

class throwC extends Controller
{
  public function throwDice ($id)
  {
    $authPlayer = auth ()->user ();

    if ($authPlayer->id == $id)
    {
      if (ThrowDice::checkRole ($id))
      {
        ThrowDice::create ($id);

        return response ()->json ([
          'success' => true,
          'message' => 'Making a throw ...'
        ], 200);
      }

      return response ()->json ([
        'success' => false,
        'message' => 'Unauthorized, only players can do so.'
      ], 403);
    }

    return response ()->json ([
      'success' => false,
      'message' => 'Unauthenticated, NOT allowing the throw.'
    ], 401);
  }

  public function deleteThrow ($id)
  {
    $authPlayer = auth ()->user ();

    if ($authPlayer->id == $id)
    {
      if (ThrowDice::checkRole ($id))
      {
        ThrowDice::deleteThrows ($id);

        return response ()->json ([
          'success' => true,
          'message' => 'Deleting all throws.'
        ], 200);
      }

      return response ()->json ([
        'success' => false,
        'message' => 'Unauthorized, only players can do so.'
      ], 403);
    }

    return response ()->json ([
      'success' => false,
      'message' => 'Unauthenticated, NOT allowing the delete.'
    ], 401);
  }
}

