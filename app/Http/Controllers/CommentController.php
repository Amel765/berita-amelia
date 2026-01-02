<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $newsId)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'content' => 'required|string'
        ]);

        $news = News::findOrFail($newsId);
        
        // Check if news exists and is published
        if ($news->status !== 'published') {
            return redirect()->back()->with('error', 'Tidak dapat memberikan komentar pada berita ini.');
        }

        $comment = new Comment();
        $comment->news_id = $newsId;
        $comment->author_name = $request->author_name;
        $comment->author_email = $request->author_email;
        $comment->content = $request->content;
        $comment->status = 'pending'; // Default status for new comments
        $comment->save();

        return redirect()->back()->with('success', 'Komentar Anda telah dikirim dan menunggu persetujuan.');
    }
}