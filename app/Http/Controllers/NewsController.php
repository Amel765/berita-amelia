<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::where('status', 'published')
                    ->with('category', 'user')
                    ->orderBy('published_at', 'desc')
                    ->paginate(10);
        
        $categories = Category::all();
        
        return view('news.index', compact('news', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $news = News::where('slug', $slug)
                    ->where('status', 'published')
                    ->with('category', 'user', 'comments')
                    ->firstOrFail();
        
        $relatedNews = News::where('category_id', $news->category_id)
                           ->where('id', '!=', $news->id)
                           ->where('status', 'published')
                           ->limit(4)
                           ->get();
        
        return view('news.show', compact('news', 'relatedNews'));
    }
    
    /**
     * Display news by category
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $news = News::where('category_id', $category->id)
                    ->where('status', 'published')
                    ->with('category', 'user')
                    ->orderBy('published_at', 'desc')
                    ->paginate(10);
        
        $categories = Category::all();
        
        return view('news.category', compact('news', 'category', 'categories'));
    }
}