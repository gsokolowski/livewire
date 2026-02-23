<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display the specified post.
     */
    public function show(Post $post): View
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
