<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $login_user = User::where('email', 'admin@example.com')->first();
        $response = $this->actingAs($login_user)->post(route('login'), [
            'email' => 'admin@example.com',
            'password' => 'adminpass',
        ]);
        $response->assertRedirect(route('post.index'));
        $this->assertAuthenticatedAs($login_user);
    }
}
