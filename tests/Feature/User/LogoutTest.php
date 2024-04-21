<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_logout(): void
    {
        $login_user = User::where('email', 'admin@example.com')->first();
        $response = $this->actingAs($login_user)->post(route('logout'));
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
