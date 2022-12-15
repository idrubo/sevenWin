<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Player;
use App\Models\ThrowDice;

class listC extends Controller
{
  public function listPlayers ()
  {
    $id = auth ()->user ()->id;

    if (ThrowDice::checkAdmin ($id))
    {
      $list = ThrowDice::lstPlayers ();

      return response ()->json ([
        'success' => true,
        'message' => 'Listing an average for every player.',
        'list'    => $list
      ], 200);
    }

    return response ()->json ([
      'success' => false,
      'message' => 'Unauthorized, only admins can do so.'
    ], 403);
  }

  public function getMean ()
  {
    $id = auth ()->user ()->id;

    if (ThrowDice::checkAdmin ($id))
    {
      $avg = ThrowDice::getAverage ();

      return response ()->json ([
        'success' => true,
        'message' => 'Showing an all-players average.',
        'average' => $avg
      ], 200);
    }

    return response ()->json ([
      'success' => false,
      'message' => 'Unauthorized, only admins can do so.'
    ], 403);
  }

  public function loser ()
  {
    $id = auth ()->user ()->id;

    if (ThrowDice::checkAdmin ($id))
    {
      $l = ThrowDice::loser ();

      return response ()->json ([
        'success' => true,
        'message' => 'Showing lowest average player.',
        'average' => $l
      ], 200);
    }

    return response ()->json ([
      'success' => false,
      'message' => 'Unauthorized, only admins can do so.'
    ], 403);
  }

  public function winner ()
  {
    $id = auth ()->user ()->id;

    if (ThrowDice::checkAdmin ($id))
    {
      $w = ThrowDice::winner ();

      return response ()->json ([
        'success' => true,
        'message' => 'Showing best average player.',
        'average' => $w
      ], 200);
    }

    return response ()->json ([
      'success' => false,
      'message' => 'Unauthorized, only admins can do so.'
    ], 403);
  }
}

