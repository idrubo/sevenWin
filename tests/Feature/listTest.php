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

    $this->json ('get', "/api/players/", [], $headers)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'Listing an average for every player.',
         ]);
  }
}

?>

