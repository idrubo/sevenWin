<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Player;

class authTest extends TestCase
{
  public function testRegisterSuccess ()
  {
    $post = [
      'name'     => 'name1',
      'email'    => 'name1@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post)
         ->assertStatus(201)
         ->assertJson ([
           'message' => 'Player successfully created.',
         ]);
  }

  public function testAnonymousSuccess ()
  {
    $post = [
      'name'     => '',
      'email'    => 'name2@s.com',
      'password' => '12345678',
      'role'     => 'guest',
    ];

    $this->json ('post', '/api/players/', $post)
         ->assertStatus(201)
         ->assertJson ([
           'message' => 'Player successfully created.',
         ]);
  }

  public function testRegisterRequiresPasswordEmailNameAndRole ()
  {
    $this->json ('post', '/api/players')
         ->assertStatus (400)
         ->assertJson ([
           'success' => false,
           'message' => 'Data not validated.',
         ]);
  }

  public function testLoginSuccess ()
  {
    $post = [
      'name'     => 'login1',
      'email'    => 'login1@s.com',
      'password' => '12345678',
      'role'     => 'player',
    ];

    $this->json ('post', '/api/players/', $post);

    $post = [
      'email'    => 'login1@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'Player logged in succesfully, use token to authenticate.',
         ]);
  }

  public function testLoginRequiresPasswordAndEmail ()
  {
    $this->json ('post', '/api/login/')
         ->assertStatus (400)
         ->assertJson ([
           'success' => false,
           'message' => 'Data not validated.',
         ]);
  }

  public function testLoginFail ()
  {
    $post = [
      'email'    => 'login1@s.com',
      'password' => '99999999',
    ];

    $this->json ('post', '/api/login/', $post)
         ->assertStatus (401)
         ->assertJson ([
           'success' => false,
           'message' => 'Player authentication failed.',
         ]);
  }

  public function testLogoutSuccess ()
  {
    $post = [
      'email'    => 'login1@s.com',
      'password' => '12345678',
    ];

    $this->json ('post', '/api/login/', $post);

    $token = auth ()->user ()->createToken ('passport_token')->accessToken;

    $headers = ['Authorization' => "Bearer $token"];

    $this->json ('post', '/api/logout', [], $headers)
         ->assertStatus (200)
         ->assertJson ([
           'success' => true,
           'message' => 'User logged out.'
         ]);

    $player = Player::where ('email', 'login1@s.com')->first ();
 
    $this->assertEquals(null, $player->api_token);
  }
}

