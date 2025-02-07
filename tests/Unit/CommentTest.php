<?php

namespace Tests\Unit;

use App\Models\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function test_comment_can_be_created_with_valid_data()
    {
        // Simulasi data komentar
        $data = [
            'article_id' => 1, // ID artikel simulasi
            'user_id' => 1,    // ID user simulasi
            'content' => 'This is a test comment.',
        ];

        // Membuat instance komentar tanpa menyimpannya ke database
        $comment = new Comment($data);

        // Memastikan properti pada instance benar
        $this->assertEquals(1, $comment->article_id);
        $this->assertEquals(1, $comment->user_id);
        $this->assertEquals('This is a test comment.', $comment->content);
    }
}