<?php

namespace App\Http\Controllers\Panel;

use App\Tag;
use App\Post;
use App\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $post_categories = PostCategory::all();
        $tags = Tag::orderBy('id', 'desc')->get();
        $posts = Post::all();

        return view('panel.blog.index', compact('post_categories', 'tags', 'posts'));
    }
}
