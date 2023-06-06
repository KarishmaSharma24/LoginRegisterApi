<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Trait\Response;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use  Response;
    
    public function store(PostRequest $request){
        $post = new Post();
        $post->user_id =$request->user_id;
        $post->title = $request->title;
        $post->description = $request->description;
        if(!$request->hasFile('image')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $file = $request->file('image');   
        $path = public_path() . '/uploads/';
        $file->move($path, $file->getClientOriginalName());
        $post->image = $path . $file->getClientOriginalName();
        $post->save();
        if(!$post){
            return $this->error('UnAuthorised User', 401, '');
        }
        return $this->success('post created successfully', 200, $post);
        
    }

    public function show($id){
        $post = Post::find($id);
        if(empty($post)){
            return $this->error('post not found', 401, '');
        }
        return $this->success('post get successfully', 200, $post);
    }

    public function update(Request $request, $id){
        $post = Post::find($id);
        if(empty($post)){
            return $this->error('post not found', 401, '');
        }
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->description = $request->description;
        if(!$request->hasFile('image')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $file = $request->file('image');   
        $path = public_path() . '/uploads/';
        $file->move($path, $file->getClientOriginalName());
        $post->image = $path . $file->getClientOriginalName();
        $post->save();
        return $this->success('post updated successfully', 200, '');
    }

    public function destory($id){
        $post = Post::find($id);
        if(empty($post)){
            return $this->error('post not found', 401, '');
        }
        $post->delete();
        return $this->success('post deleted successfully', 200, '');
    }
}
