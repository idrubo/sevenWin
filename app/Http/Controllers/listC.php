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
    $list = ThrowDice::lstPlayers ();

    return response ()->json ([
      'success' => true,
      'message' => 'Listing an average for every player.',
      'list'    => $list
    ], 200);
  }

  public function getMean ()
  {
    $avg = ThrowDice::getAverage ();

    return response ()->json ([
      'success' => true,
      'message' => 'Showing an all-players average.',
      'average' => $avg
    ], 200);
  }

  public function loser ()
  {
    $l = ThrowDice::loser ();

    return response ()->json ([
      'success' => true,
      'message' => 'Showing lowest average player.',
      'average' => $l
    ], 200);
  }

  public function winner ()
  {
    $w = ThrowDice::winner ();

    return response ()->json ([
      'success' => true,
      'message' => 'Showing best average player.',
      'average' => $w
    ], 200);
  }
}

