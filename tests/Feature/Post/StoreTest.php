<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class StoreTest extends TestCase
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
    public function test_store(): void
    {
        // login_userが認証を通過しているとする
        $this->assertAuthenticatedAs($this->login_user);
        $response = $this->actingAs($this->login_user)->post(route('post.store'), [
            'title' => 'Test Title',
            'body' => 'Test Body',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('post.index'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Title',
            'body' => 'Test Body',
        ]);
    }

    public function test_store_validation_error(): void
    {
        // login_userが認証を通過しているとする
        $this->assertAuthenticatedAs($this->login_user);
        $response = $this->actingAs($this->login_user)->post(route('post.store'), [
            'title' => '',
            'body' => '',
        ]);
        $response->assertSessionHasErrors(['title', 'body']);
    }
}
