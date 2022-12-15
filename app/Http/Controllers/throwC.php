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
      if (ThrowDice::checkPlayer ($id))
      {
        $result = ThrowDice::create ($id);

        return response ()->json ([
          'success' => true,
          'message' => 'Making a throw ...',
          'result'  => $result,
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

  public function deleteThrows ($id)
  {
    $authPlayer = auth ()->user ();

    if ($authPlayer->id == $id)
    {
      if (ThrowDice::checkPlayer ($id))
      {
        ThrowDice::delThrow ($id);

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

  public function listThrows ($id)
  {
    $authPlayer = auth ()->user ();

    if ($authPlayer->id == $id)
    {
      if (ThrowDice::checkPlayer ($id))
      {
        $list = ThrowDice::listThrows ($id);

        return response ()->json ([
          'success' => true,
          'message' => 'Listing all throws.',
          'list'    => $list
        ], 200);
      }

      return response ()->json ([
        'success' => false,
        'message' => 'Unauthorized, only players can do so.'
      ], 403);
    }

    return response ()->json ([
      'success' => false,
      'message' => 'Unauthenticated, NOT allowing the listing.'
    ], 401);
  }
}

