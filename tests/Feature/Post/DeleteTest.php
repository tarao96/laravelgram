<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    private $login_user;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->login_user = User::where('email', 'admin@example.com')->first();
        $this->actingAs($this->login_user)->post(route('login'), [
            'email' => 'admin@example.com',
            'password' => 'adminpass',
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_delete(): void
    {
        $response = $this->actingAs($this->login_user)->delete(route('post.delete', ['id' => 1]));
        $response->assertStatus(302);
        $response->assertRedirect(route('user.mypage'));
        $this->assertDatabaseMissing('posts', [
            'id' => 1,
        ]);
    }
}
