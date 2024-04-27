<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditTest extends TestCase
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
    public function test_edit(): void
    {
        $response = $this->get(route('post.edit', ['id' => 1]));
        $response->assertStatus(200);
        $response->assertViewIs('post.edit');
        $response->assertSee('投稿編集');
    }
}
