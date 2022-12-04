<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Player extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $table = 'players';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function roles ()
  {
    return $this->hasOne (Role::class, 'idrolpla', 'id');
  }

  public static function savePlayer ($r)
  {
    $player = new Player ();

    $player->name        = $r->name;
    $player->email       = $r->email;
    $player->password    = Hash::make ($r->password);

    $player->save ();

    $role = new Role ();

    $player = Player::where ('email', $r->email)->get ();

    foreach ($player as $p)
    {
      $role->idrolpla = $p->id;
      $role->role     = $r->role;
    }

    $role->save ();

    return true;
  }
}

