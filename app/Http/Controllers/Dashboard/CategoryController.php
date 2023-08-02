<?php

namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Store;
use App\Http\Requests\Category\Put;

class CategoryController extends Controller
{
    //


    public function index() 
    {
      // compact('categories')
      $categories = Category::paginate(2);

   
      return Inertia::render('DashBoard/Category/Index',  ['categories' => $categories]);
    }

    public function create() {
        return Inertia::render('DashBoard/Category/Create');
    }

    // public function store(Request $request) {
        
    //   Category::create([
    //     'title'=> $request->title,
    //     'slug' => $request->slug
    //   ]);
    // }  

    public function show() {

    }

    public function store(Store $request) {
      Category::create($request->validated());

      return to_route('category.index')->with("message", "created category successfully");;
    }

    public function edit(Category $category) {
      // return Inertia::render('DashBoard/Category/Edit', compact('category'));
      return Inertia::render('DashBoard/Category/Edit', ['category' => $category]);
    }

    public function update(Put $request, Category $category) {
      $category->update($request->validated());

      return redirect()->route('category.index')->with("message", "updated category successfully");
      
    }


    public function destroy(Category $category) {
      $category->delete();
      return to_route('category.index')->with("message", "deleted category successfully");                                       
    }
}
