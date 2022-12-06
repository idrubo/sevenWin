<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThrowDice extends Model
{
  use HasFactory;

  protected $table = 'throwDices';

  public static function create ($id)
  {
    $throw = new ThrowDice ();

    $throw->idthrpla = $id;
    $throw->result   = rand (1, 6) + rand (1, 6);
    $throw->result == 7 ? $throw->win = 'wins' : $throw->win = 'loses';

    $throw->save ();
  }

  public static function checkRole ($id)
  {
    $player = Player::where ('id', $id)->get ();

    foreach ($player as $p)
      if ($p->roles->role == "player") return true;
      else return false;
  }
}

