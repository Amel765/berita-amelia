<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('news', 'user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::with('news', 'user')->findOrFail($id);
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,approved,spam'
        ]);

        $comment->update(['status' => $request->status]);

        return redirect()->route('admin.comments.index')->with('success', 'Status komentar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Komentar berhasil dihapus.');
    }
    
    /**
     * Update the status of a comment to approved
     */
    public function approve(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['status' => 'approved']);
        
        return redirect()->back()->with('success', 'Komentar berhasil disetujui.');
    }
    
    /**
     * Update the status of a comment to spam
     */
    public function markAsSpam(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['status' => 'spam']);
        
        return redirect()->back()->with('success', 'Komentar berhasil ditandai sebagai spam.');
    }
}