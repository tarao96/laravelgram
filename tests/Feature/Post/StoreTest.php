<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
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
        Storage::fake('s3');
        $file = UploadedFile::fake()->image('test.jpg');
        // login_userが認証を通過しているとする
        $this->assertAuthenticatedAs($this->login_user);
        $response = $this->actingAs($this->login_user)->post(route('post.store'), [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'image' => $file,
        ]);
        $response->assertStatus(302);
        Storage::disk('s3')->assertExists('images/' . $file->hashName());
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
