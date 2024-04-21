<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class UpdateTest extends TestCase
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

    public function test_update()
    {
        Storage::fake('s3');
        $file = UploadedFile::fake()->image('test.jpg');
        $post_id = Post::first()->id;
        $response = $this->actingAs($this->login_user)->post(route('post.update', ['id' => $post_id]), [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
            'image' => $file,
        ]);
        $response->assertStatus(302);
        Storage::disk('s3')->assertExists('images/' . $file->hashName());
        $response->assertRedirect(route('user.mypage'));
        $this->assertDatabaseHas('posts', [
            'id' => $post_id,
            'title' => 'Updated Title',
            'body' => 'Updated Body',
        ]);
    }
}
