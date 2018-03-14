<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    public function testGuestShouldNotAccessAdmin()
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
    }

    public function testAdminCanOnlyAccessAdmin()
    {
        $this->user->user_type = 'host';
        $response = $this->actingAs($this->user)->get('/admin');
        $response->assertStatus(302);

        $this->user->user_type = 'user';
        $response = $this->actingAs($this->user)->get('/admin');
        $response->assertStatus(302);

        $this->user->user_type = 'admin';
        $response = $this->actingAs($this->user, 'admin')->get('/admin');
        $response->assertStatus(200);
    }
}
