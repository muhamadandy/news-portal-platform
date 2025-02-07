<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Tests\TestCase;

class ReplyIntegrationTest extends TestCase
{
    public function test_user_can_reply_to_comment()
    {
        $uniqueEmail = 'testuser' . uniqid() . '@example.com';

        $user = User::create([
            'name' => 'Test User',
            'email' => $uniqueEmail,
            'password' => bcrypt('password'),
        ]);

        $category = Category::create([
            'name' => 'Test Category',
        ]);

        $this->actingAs($user);

        $article = Article::create([
            'title' => 'Test Article'. uniqid(),
            'content' => 'This is a test article content.',
            'user_id' => $user->id,
            'category_id' => $category->id,
            'slug' => 'test-article-' . uniqid(),
            'image' => 'test-image.jpg',
            'is_highlighted' => false,
        ]);


        $comment = Comment::create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'content' => 'This is a parent comment.',
        ]);

        $response = $this->post(route('comments.reply'), [
            'parent_id' => $comment->id,
            'article_id' => $article->id,
            'content' => 'This is a reply to the parent comment.',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('comments', [
            'content' => 'This is a reply to the parent comment.',
            'article_id' => $article->id,
            'parent_id' => $comment->id,
        ]);
    }
}