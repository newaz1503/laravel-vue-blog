<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.frontend.master');
    }

    public function blogPost(){
        $posts = Post::with('user', 'category')->get();
        return response()->json([
           'posts' => $posts
        ],200);
    }
    public function singlePost($id){
        $post = Post::with('user', 'category')->where('id', $id)->first();
        return response()->json([
            'post' => $post,
        ],200);
    }

    public function blogCategory(){
        $categories = Category::latest()->get();
        return response()->json([
            'categories' => $categories,
        ],200);
    }

    public function latestPost(){
        $post = Post::with('user', 'category')->latest()->take(5)->get();
        return response()->json([
            'post' => $post,
        ],200);
    }

    public function postByCategory($id){
        $posts = Post::with('user', 'category')->where('category_id', $id)->get();
        return response()->json([
            'posts' => $posts,
        ],200);
    }

    public function search(){
        $static_request = \Request::get('s');
        if ($static_request == null){
            return $this->blogPost();
        }else{
            $posts = Post::with('user', 'category')
                ->where('title', 'LIKE', "%$static_request%" )
                ->orWhere('description', 'LIKE', "%$static_request%" )
                ->get();
            return response()->json([
                'posts' => $posts,
            ],200);
        }

    }


}
