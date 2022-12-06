<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Player;

class playerTest extends TestCase
{
  public function testModifySuccess ()
  {
    $post = [
      'name'     => 'modify1',
      'email'    => 'modify1@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'modify1@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id;
    $this->json ('put', "/api/players/$id/", ['name' => 'modify1000'], $headers)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'Player name modified.'
         ]);
  }

  public function testModifyFail ()
  {
    $post = [
      'email'    => 'modify1@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id - 1;
    $this->json ('put', "/api/players/$id/", ['name' => 'modify1000'], $headers)
         ->assertStatus (401)
         ->assertJson ([
           'success' => false,
           'message' => 'Unauthenticated, player name NOT modified.'
         ]);
  }
}

?>

