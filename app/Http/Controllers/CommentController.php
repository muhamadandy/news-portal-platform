<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Menyimpan komentar baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'content' => 'required|string',
        ]);

        Comment::create([
            'article_id' => $validated['article_id'],
            'content' => $validated['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    // Melaporkan komentar
public function report(Request $request, $commentId)
{
    // Periksa apakah laporan sudah ada
    $existingReport = Report::where('comment_id', $commentId)
        ->where('user_id', Auth::id())
        ->first();

    if ($existingReport) {
        return redirect()->back()->with('error', 'Anda sudah melaporkan komentar ini sebelumnya.');
    }

    // Jika belum ada, buat laporan baru
    Report::create([
        'comment_id' => $commentId,
        'user_id' => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Komentar berhasil dilaporkan!');
}


    public function reply(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'article_id' => 'required|exists:articles,id',
            'parent_id' => 'required|exists:comments,id',
        ]);

        $parentComment = Comment::findOrFail($request->parent_id);


        $comment = Comment::create([
            'content' => $request->content,
            'article_id' => $request->article_id,
            'parent_id' => $request->parent_id,
            'user_id' => Auth::id(),
        ]);

        $comment->save();

        return redirect()->back()->with('success', 'Balasan berhasil ditambahkan!');
    }
}