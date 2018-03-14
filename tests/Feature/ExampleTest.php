<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    private $user;
    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGuestCannotAccessProfilePage()
    {
        $response = $this->get('/profile');
        $response->assertStatus(302);
    }
    
    public function testUserOrHostCanAccessProfilePage()
    {
        
        $this->user->user_type = 'host';

        $response = $this->actingAs($this->user)->get('/profile');
        $response->assertStatus(200);

        $this->user->user_type = 'user';
        $response = $this->actingAs($this->user)->get('/profile');
        $response->assertStatus(200);
    }

    public function testUserShouldNotAccessHostPages()
    {
        $this->user->user_type = 'user';
        $response = $this->actingAs($this->user)->get('/profile/listings');
        $response->assertStatus(302);
    }

    public function testHostCanAccessHostPages()
    {
        $this->user->user_type = 'host';
        $response = $this->actingAs($this->user)->get('/profile/listings');
        $response->assertStatus(200);
    }

    
}
