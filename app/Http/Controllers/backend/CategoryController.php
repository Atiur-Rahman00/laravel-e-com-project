<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Image;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //To crate and view category 
        $categories = Category::all();
        return view('backend.product.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'category_name' => 'required|unique:categories,category_name',
            'description' => 'max:300',
            'category_image' => 'image|mimes:jpg,png'
        ]);
        $image = $request->file('category_image');
        if(!empty($image)){
            $image_name = Str::slug($request->category_name)."_".time().".".
            $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 256)->save(public_path('storage/uploads/category/').$image_name);
            $category_image = $image_name;
        }

        $category = new Category();
        $category->category_name = Str::lower($request->category_name);
        $category->parent_id = $request->parent_name;
        $category->slug = Str::slug($request->category_name);
        $category->category_description = $request->category_description;
        $category->category_image = $category_image;
        $category->save();
        return back()->with('insdone', 'category added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
