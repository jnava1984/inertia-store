<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Post\Put;
use App\Http\Requests\Post\Store;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    public function index() {
        $posts = Post::paginate(2);
        return Inertia::render('DashBoard/Post/Index', compact('posts'));
    }

    public function create() {
        $categories = Category::all();
        return Inertia::render('DashBoard/Post/Create', compact('categories'));
    }

    public function store(Store $request) {
 
        Post::create($request->validated());
  
        return to_route('post.index')->with("message", "created post successfully");;
    }

    public function edit(Post $post) {
        $categories = Category::all();
        return Inertia::render('DashBoard/Post/Edit', compact('post', 'categories'));
      }

    public function update(Put $request, Post $post) {

        $post->update($request->validated());

        return redirect()->route('post.index')->with("message", "updated post successfully");
    
    } 

    public function destroy(Post $post) {
        $post->delete();
        return to_route('post.index')->with("message", "deleted post successfully");                                       
      }
  

    

}
