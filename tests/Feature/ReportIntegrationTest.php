<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Tests\TestCase;

class ReportIntegrationTest extends TestCase
{
    public function test_user_can_report_comment()
    {
        $uniqueEmail = 'testuser' . uniqid() . '@example.com';

        // Buat user
        $user = User::create([
            'name' => 'Test User',
            'email' => $uniqueEmail,
            'password' => bcrypt('password'),
        ]);

        // Buat kategori
        $category = Category::create([
            'name' => 'Test Category',
        ]);

        $this->actingAs($user);

        // Buat artikel
        $article = Article::create([
            'title' => 'Test Article' . uniqid(),
            'content' => 'This is a test article content.',
            'user_id' => $user->id,
            'category_id' => $category->id,
            'slug' => 'test-article-' . uniqid(),
            'image' => 'test-image.jpg',
            'is_highlighted' => false,
        ]);

        // Buat komentar
        $comment = Comment::create([
            'content' => 'This is a test comment.',
            'article_id' => $article->id,
            'user_id' => $user->id,
        ]);

        // Kirim request POST untuk melaporkan komentar
        $response = $this->post(route('comments.report', $comment->id));

        // Pastikan redirect berhasil
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        // Periksa apakah laporan ada di database
        $this->assertDatabaseHas('reports', [
            'comment_id' => $comment->id,
            'user_id' => $user->id,
        ]);
    }
}