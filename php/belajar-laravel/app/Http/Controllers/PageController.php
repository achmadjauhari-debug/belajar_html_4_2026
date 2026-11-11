<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting; //untuk input
use App\Models\Blog;
use App\Models\CategoryBlog;

class PageController extends Controller
{
    public function faq()
    {
        return view('faq.index');
    }

    public function contact()
    {
        $setting = Setting::get();//untuk input
        return view('contact.index', compact('setting'));
    }

    public function blog(Request $request)
    {
        $categories = CategoryBlog::withCount('blogs')->get();
        $totalBlogsCount = Blog::count();
        // $blogs = Blog::with('category')->orderBy('id', 'desc')->get();
        $blogs = Blog::with('category')->latest();//ngambil query yg terbaru

        if($request->filled('category')) {
           $blogs->wherehas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
           });
        }

        if($request->filled('search')) {
            $searchTerm = $request->search;

            $blogs->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('brief_description', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

// 1. Ambil 1 artikel terbaru sebagai postingan utama (Featured Post)
    $featuredPost = null;
    if(!$request->filled('category') && !$request->filled('search')) {
        $featuredPost=(clone $blogs)->first();
    }

    if($featuredPost){
        $blogs->where('id', '!=', $featuredPost->id);
    }
    $blogs = $blogs->paginate(9)->withQueryString();
    // return $blogs;

        return view('blog.index', compact('blogs', 'categories','totalBlogsCount', 'featuredPost'));               
    }

    public function showBlog(string $slug)
    {
    $blog = Blog::where('slug',$slug)->with('category')->first();    
    return view('blog.show', compact('blog'));
    }
 
 
    public function outlet()
    {
        return view('outlet.index');               
    }

}
