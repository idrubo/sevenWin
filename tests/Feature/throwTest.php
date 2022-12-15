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
      'role'     => 'admin',
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
           'message' => 'Unauthorized, only players can do so.'
         ]);
  }

  public function testDeleteSuccess ()
  {
    $post = [
      'name'     => 'delete1',
      'email'    => 'delete1@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'delete1@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id;

    for ($i = 0; $i < 5; $i++)
      $this->json ('post', "/api/players/$id/games/", [], $headers);

    $this->json ('delete', "/api/players/$id/games/", [], $headers)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'Deleting all throws.'
         ]);
  }

  public function testDeleteAuthenticateFail ()
  {
    $post = [
      'name'     => 'delete2',
      'email'    => 'delete2@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'delete2@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id - 1;
    $this->json ('delete', "/api/players/$id/games/", [], $headers)
         ->assertStatus (401)
         ->assertJson ([
           'success' => false,
           'message' => 'Unauthenticated, NOT allowing the delete.'
         ]);
  }

  public function testDeleteAuthorizeFail ()
  {
    $post = [
      'name'     => 'delete3',
      'email'    => 'delete3@s.com',
      'password' => '12345678',
      'role'     => 'admin',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'delete3@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id;
    $this->json ('delete', "/api/players/$id/games/", [], $headers)
         ->assertStatus (403)
         ->assertJson ([
           'success' => false,
           'message' => 'Unauthorized, only players can do so.'
         ]);
  }

  public function testListSuccess ()
  {
    $post = [
      'name'     => 'list1',
      'email'    => 'list1@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'list1@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id;

    for ($i = 0; $i < 5; $i++)
      $this->json ('post', "/api/players/$id/games/", [], $headers);

    $this->json ('get', "/api/players/$id/games/", [], $headers)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'Listing all throws.',
         ]);
  }

  public function testListAuthenticateFail ()
  {
    $post = [
      'name'     => 'list2',
      'email'    => 'list2@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'list2@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id - 1;
    $this->json ('get', "/api/players/$id/games/", [], $headers)
         ->assertStatus (401)
         ->assertJson ([
           'success' => false,
           'message' => 'Unauthenticated, NOT allowing the listing.'
         ]);
  }

  public function testListAuthorizeFail ()
  {
    $post = [
      'name'     => 'list3',
      'email'    => 'list3@s.com',
      'password' => '12345678',
      'role'     => 'admin',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'list3@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    $id = auth ()->user ()->id;
    $this->json ('get', "/api/players/$id/games/", [], $headers)
         ->assertStatus (403)
         ->assertJson ([
           'success' => false,
           'message' => 'Unauthorized, only players can do so.'
         ]);
  }
}

?>

