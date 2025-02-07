<?php

namespace Tests\Unit;

use App\Models\Comment;
use PHPUnit\Framework\TestCase;

class ReplyTest extends TestCase
{
    public function test_user_can_reply_to_comment()
    {
        // Data komentar induk (parent comment)
        $parentCommentData = [
            'id' => 1,
            'article_id' => 1,
            'content' => 'This is a parent comment.',
            'user_id' => 1,
        ];

        // Membuat instance parent comment (simulasi tanpa database)
        $parentComment = new Comment($parentCommentData);

        // Data balasan (reply) komentar
        $replyData = [
            'content' => 'This is a reply.',
            'article_id' => $parentComment->article_id,
            'parent_id' => $parentComment->id,
            'user_id' => 2, // User yang membalas
        ];

        // Membuat instance reply comment
        $reply = new Comment($replyData);

        // Memastikan reply memiliki data yang sesuai
        $this->assertEquals('This is a reply.', $reply->content);
        $this->assertEquals($parentComment->id, $reply->parent_id);
        $this->assertEquals($parentComment->article_id, $reply->article_id);
        $this->assertEquals(2, $reply->user_id);
    }
}