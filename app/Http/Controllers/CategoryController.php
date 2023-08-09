<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use App\Models\Category;
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
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $depts = Dept::all()->where('d_active',1);
        return view('categories.create', compact('depts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $categoryData = $request->validate([
            'name' => ['required','min:3', Rule::unique('categories', 'name')],  
        ]);

        

        $category = Category::create($categoryData);

        if($request->depts){
            $category->depts()->Attach($request->depts);
        }

        return redirect()->back()->with('success', 'Category has been created');
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
        $depts = Dept::all()->where('d_active',1);
        return view('categories.edit', compact('category','depts'));
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
        $priorityData = $request->validate([
            'name' => ['required','min:3', Rule::unique('priorities', 'name')->ignore($category)],
            
        ]);

        $category['status'] = $request->has('status') ? 1 : 0;
        $category['name'] = $request['name'];
        
        
        $category->save();

        $category->depts()->sync($request->depts);

        return redirect()->back()->with('success', 'Category updated');
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
