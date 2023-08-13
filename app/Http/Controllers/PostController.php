<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Image;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post)
    {
       return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]); 
    }

    public function show(Post $post )
    {
        return view('/posts/show')->with(['post' => $post, 'images' => $post->images()->get()]);
    }
    
    
    public function store(PostRequest $request, Post $post, Image $image)
    {
         //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        $input = $request['post'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        //$input += ['image_path' => $image_url];  //追加
        $post->fill($input)->save();
        $image->image_path = $image_url;
        $image->post_id = $post->id;
        $image->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post  = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}