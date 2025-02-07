<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Tests\TestCase;

class CommentIntegrationTest extends TestCase
{
    public function test_user_can_submit_comment_from_form()
    {
        $uniqueEmail = 'testuser' . time() . '@example.com';

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
            'slug' => 'test-article'. uniqid(),
            'image' => 'test-image.jpg',
            'is_highlighted' => false,
        ]);


        $response = $this->post(route('comments.store'), [
            'article_id' => $article->id,
            'content' => 'Integration test comment.',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('comments', [
            'content' => 'Integration test comment.',
            'article_id' => $article->id,
        ]);
    }
}