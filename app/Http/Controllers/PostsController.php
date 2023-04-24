<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function show(Post $post)
    {
        $post->load(['user','category']);
        SEOTools::setTitle($post->title);
        SEOTools::setDescription($post->bodyPreview(255));
        return view('front.post.show',compact('post'));
    }
}
