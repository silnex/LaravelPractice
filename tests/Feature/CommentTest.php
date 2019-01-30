<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Post;
use App\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->post = factory(Post::class)->create([
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function add_comment_on_post()
    {
        $comment = factory(comment::class)->make([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
        // post request comment create
        $response = $this->actingAs($this->user)->post("/posts/{$this->post->id}/comments", $comment->toArray());
        // $response->dump();
        // check db
        $this->assertDatabaseHas('comments', [
            'description' => $comment->description,
        ]);
    }

    /** @test */
    public function add_comment_on_the_post_have_password() {
        // update password in post

        // add test without password

        // check false

        // add test with password

        // check true
    }
}
