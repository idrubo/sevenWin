<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use Laravel\Passport\TokenRepository;

use App\Models\ThrowDice;

class listTest extends TestCase
{
  public function testListPlayers ()
  {
    $post = [
      'name'     => 'avg1',
      'email'    => 'avg1@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'avg1@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id;

    for ($i = 0; $i < 10; $i++)
      $this->json ('post', "/api/players/$id/games/", [], $headers);

    $this->json ('get', '/api/players/', [], $headers)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'Listing an average for every player.',
         ]);
  }

  public function testGetMean ()
  {
    $post = [
      'name'     => 'avg2',
      'email'    => 'avg2@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'avg2@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id;

    for ($i = 0; $i < 15; $i++)
      $this->json ('post', "/api/players/$id/games/", [], $headers);

    $this->json ('get', '/api/players/ranking/', [], $headers)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'Showing an all-players average.',
         ]);
  }

  public function testGetLoser ()
  {
    $post = [
      'name'     => 'avg3',
      'email'    => 'avg3@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'avg3@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id;

    for ($i = 0; $i < 20; $i++)
      $this->json ('post', "/api/players/$id/games/", [], $headers);

    $this->json ('get', '/api/players/ranking/loser/', [], $headers)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'Showing lowest average player.',
         ]);
  }

  public function testGetWinner ()
  {
    $post = [
      'email'    => 'avg3@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $this->json ('get', '/api/players/ranking/winner/', [], $headers)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'Showing best average player.',
         ]);
  }
}

?>

