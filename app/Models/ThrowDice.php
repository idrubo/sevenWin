<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Player;

class ThrowDice extends Model
{
  use HasFactory;

  protected $table = 'throwDices';

  public function players ()
  {
    return $this->belongsTo (Player::class, 'idthrpla', 'id');
  }

  public static function create ($id)
  {
    $throw = new ThrowDice ();

    $throw->idthrpla = $id;
    $throw->result   = rand (1, 6) + rand (1, 6);
    $throw->result == 7 ? $throw->win = 'wins' : $throw->win = 'loses';

    $throw->save ();
  }

  public static function delThrow ($id)
  {
    ThrowDice::where('idthrpla', $id)->delete ();
  }

  public static function listThrows ($id)
  {
    $list = array ();

    $throws = ThrowDice::where('idthrpla', $id)->get ();

    foreach ($throws as $t)
    {
      $cols = array ('name' => $t->players->name, 'result' => $t->result, 'win' => $t->win);
      array_push ($list, (object) $cols);
    }

    return $list;
  }

  public static function checkRole ($id)
  {
    $player = Player::where ('id', $id)->get ();

    foreach ($player as $p)
      if ($p->roles->role == "player") return true;
      else return false;
  }
}

