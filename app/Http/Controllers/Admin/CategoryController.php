<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withDepth()->defaultOrder()->get();
        return view('admin.category-index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::withDepth()->defaultOrder()->get();
        return view('admin.category-create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', 'unique:categories'],
        ]);
        
        $category = new Category();
        $category->fill($request->all());
        $category->save();
        
        return redirect()->route('admin.categories.index')->with('messages', [__('messages.category_added')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::withDepth()->defaultOrder()->get();
        
        return view('admin.category-edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('categories')->ignore($id)],
        ]);
        
        $category = Category::find($id);
        $category->fill($request->all());
        $category->save();
        
        return redirect()->route('admin.categories.index')->with('messages', [__('messages.category_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        
        return redirect()->route('admin.categories.index')->with('messages', [__('messages.category_deleted')]);
    }
}
