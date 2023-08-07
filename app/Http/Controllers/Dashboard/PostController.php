<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Post\Put;
use App\Http\Requests\Post\Store;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //
    public function index() {
        $posts = Post::paginate(2);
        return Inertia::render('DashBoard/Post/Index', compact('posts'));
    }

    public function create() {
        $categories = Category::all();
        // return Inertia::render('DashBoard/Post/Create', compact('categories'));
        return Inertia::render('DashBoard/Post/Save', compact('categories'));
    }

    public function store(Store $request) {
        
        $post = Post::create($request->validated());
        $this->upload($request, $post);
        return to_route('post.index')->with("message", "created post successfully");;
    }

    public function edit(Post $post) {
      
        $categories = Category::all();
        // return Inertia::render('DashBoard/Post/Edit', compact('post', 'categories'));
        return Inertia::render('DashBoard/Post/Save', compact('post', 'categories'));
      }

    public function update(Put $request, Post $post) {
        
        $post->update($request->validated());
        $this->upload($request, $post);
        return redirect()->route('post.index')->with("message", "updated post successfully");
    
    } 

    public function destroy(Post $post) {
        $post->delete();
        return to_route('post.index')->with("message", "deleted post successfully");                                       
    }
  
    public function upload(Request $request, Post $post) {

        // $request->validate([
        //     'image' => 'required|mimes:jpg,jpeg,png,git|max:1240'
        // ]);
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        Storage::disk("public_upload")->delete("image/post/".$post->image);
        $data['image'] = $filename = time().".".$request['image']->extension();
        
        $request->image->move(public_path("image/post"), $filename);
        $post->update($data);

          
        // return to_route('post.index')->with("message", "deleted image to post successfully");                                       
    }

    public function imageDelete(Post $post) {
        Storage::disk("public_upload")->delete("image/post/".$post->image);
        $post->image = null;
        $post->save();
        return to_route('post.edit', $post->id)->with("message", "image removed to post successfully");   
    }
    

}
