<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\ThrowDice;

class throwTest extends TestCase
{
  public function testThrowSuccess ()
  {
    $post = [
      'name'     => 'throw1',
      'email'    => 'throw1@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'throw1@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id;
    $this->json ('post', "/api/players/$id/games/", [], $headers)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'Making a throw ...'
         ]);
  }

  public function testAuthenticateFail ()
  {
    $post = [
      'name'     => 'throw2',
      'email'    => 'throw2@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'throw2@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id - 1;
    $this->json ('post', "/api/players/$id/games/", [], $headers)
         ->assertStatus (401)
         ->assertJson ([
           'success' => false,
           'message' => 'Unauthenticated, NOT allowing the throw.'
         ]);
  }

  public function testAuthorizeFail ()
  {
    $post = [
      'name'     => 'throw3',
      'email'    => 'throw3@s.com',
      'password' => '12345678',
      'role'     => 'guest',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'throw3@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id;
    $this->json ('post', "/api/players/$id/games/", [], $headers)
         ->assertStatus (403)
         ->assertJson ([
           'success' => false,
           'message' => 'Only players can do so.'
         ]);
  }
}

?>

