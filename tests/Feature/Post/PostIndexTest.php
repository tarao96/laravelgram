<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get(route('post.index'));
        $response->assertStatus(200);
        $response->assertViewIs('app.index');
        // マイページといテキストがあるか
        $response->assertSee('マイページ');
    }
}
