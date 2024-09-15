<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View {
        $popularPosts = BlogPost::getPopularPosts(6);
        $popularMonthPosts = BlogPost::getPopularMonthPosts(12);
        $priorityPosts = BlogPost::getPriorityPosts(12);
        $newestPosts = BlogPost::getNewestPosts(24);

        return view('home.index', [
            'popularPosts' => $popularPosts,
            'popularMonthPosts' => $popularMonthPosts,
            'priorityPosts' => $priorityPosts,
            'newestPosts' => $newestPosts,
        ]);
    }

    public function contact(): View {
        return view('home.contact');
    }
}
