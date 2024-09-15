<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(): View {
        $posts = BlogPost::where(['is_published' => 1])
            ->orderBy('created_at', 'DESC')
            ->paginate(24);

        return view('blog.index', [
            'posts' => $posts
        ]);
    }

    public function viewCategory($slug = null): View {
        $category = BlogCategory::where('slug', $slug)->first();

        if (!$category) {
            return abort(404);
        }

        $categoryIds = [$category->id];

        if (!$category->parent_id) {
            $categoryIds = BlogCategory::where('parent_id', $category->id)
                ->orWhere('id', $category->id)
                ->distinct()
                ->select('id')
                ->get()
                ->pluck('id');
        }

        $posts = BlogPost::where(['is_published' => 1])
            ->whereIn('category_id', $categoryIds)
            ->orderBy('created_at', 'DESC')
            ->paginate(24);

        if (!$category) {
            return abort(404);
        }

        return view('blog.view-category', [
            'category' => $category,
            'posts' => $posts
        ]);
    }

    public function viewSearch(Request $req): View {
        $keyword = $req->input('q');
        $posts = BlogPost::where(['is_published' => 1])
            ->where('name', 'like', "%$keyword%")
            ->orderBy('created_at', 'DESC')
            ->paginate(24);


        return view('blog.view-search', [
            'posts' => $posts,
            'keyword' => $keyword
        ]);
    }

    public function viewTag($slug = null): View {
        $tag = Tag::where('slug', 'like', "%$slug%")->first();

        if (!$tag) {
            return abort(404);
        }

        $posts = BlogPost::where(['is_published' => 1])
            ->join('taggables', 'blog_posts.id', '=', 'taggables.taggable_id')
            ->where('taggables.tag_id', $tag->id)
            ->where('taggables.taggable_type', BlogPost::class)
            ->orderBy('created_at', 'DESC')
            ->paginate(24);

        return view('blog.view-tag', [
            'tag' => $tag,
            'posts' => $posts
        ]);
    }

    public function viewPost(Request $request, $category_slug, $slug): View {
        $post = BlogPost::where('slug', $slug)->first();

        if (!$post) {
            return abort(404);
        }

        $cookieName = Str::replace('.','',($request->ip())).'-'. $post->id;
        
        if (!$request->cookie($cookieName)) {
            Model::withoutTimestamps(fn () => $post->increment('view_count', 1));
        }
        
        Cookie::queue($cookieName, '1', 60);

        return view('blog.view-post', [
            'post' => $post
        ]);
    }
}
