<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp()
    {
        parent::setUp();
        $this->withExceptionHandling();
    }

    /**
     * @test
     */
    public function authenticated_can_create_new_posts()
    {
        $this->assertSame(0, Post::count());

        // Dummy payload
        $payload = [
            'title' => "Addicted to what the dick did",
            'body' => "the dick did"
        ];


        $this->postJson('/posts', $payload)->assertStatus(201);

        $this->assertSame(1, Post::count());

        $postData = Post::first();

        $this->assertEquals($payload['title'], $postData->title);
        $this->assertEquals($payload['body'], $postData->body);
    }
}
