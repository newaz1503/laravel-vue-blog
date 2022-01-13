<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with('user','category')->latest()->get();
        return response()->json([
           'posts' => $posts
        ],200);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required|numeric',
            'image' => 'required'
        ]);
        $currentTime = Carbon::now()->toDateString();
        $string_position = strpos($request->image, ';');
        $sub_string = substr($request->image, 0, $string_position);
        $original_extension = explode('/', $sub_string)[1];
        $imageName = $currentTime.'-'.uniqid().'.'.$original_extension;
        $resize_img = Image::make($request->image)->resize(1600, 479);
        $upload_path = public_path()."/uploads/post/";
        $resize_img->save($upload_path.$imageName);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $imageName;
        $post->save();
        return ['message', 'ok'];
    }
    public function edit($id){
        $post = Post::findOrFail($id);
        return response()->json([
            'post' => $post
        ],200);
    }
    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required|numeric',
        ]);
        $post = Post::findOrFail($id);
        if ($request->image){
            $currentTime = Carbon::now()->toDateString();
            $string_position = strpos($request->image, ';');
            $sub_string = substr($request->image, 0, $string_position);
            $original_extension = explode('/', $sub_string)[1];
            $imageName = $currentTime.'-'.uniqid().'.'.$original_extension;
            $resize_img = Image::make($request->image)->resize(1600, 579);
            $upload_path = public_path()."/uploads/post/";
            $resize_img->save($upload_path.$imageName);
            if (file_exists($upload_path.$post->image)){
                @unlink($upload_path.$post->image);
            }
        }else{
            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $imageName;
        $post->save();
        return ['message', 'ok'];
    }
    public function destroy($id){
        $post = Post::findOrFail($id);
        if (file_exists(public_path()."/uploads/post/".$post->image)){
            @unlink(public_path()."/uploads/post/".$post->image);
        }
        $post->delete();
        return response()->json([
           'message' => 'ok',
        ]);
    }
}
