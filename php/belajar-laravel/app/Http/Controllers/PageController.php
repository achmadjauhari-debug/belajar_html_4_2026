<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function faq()
    {
        return view('faq.index');
    }

    public function contact()
    {
        return view('contact.index');
    }

    public function blog()
    {
        return view('blog.index');               
    }

    public function showBlog(string $id)
    {
        return view('blog.show');
    }
}
