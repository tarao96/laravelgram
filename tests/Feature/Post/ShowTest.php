<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
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
    public function test_show(): void
    {
        $response = $this->get(route('post.show', ['id' => 1]));
        $response->assertStatus(200);
        $response->assertViewIs('app.show');
        $response->assertSee('投稿詳細');
    }
}
