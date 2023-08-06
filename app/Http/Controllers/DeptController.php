<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class DeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depts = Dept::all();

        return view('depts.index')->with('depts',$depts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('depts.create');
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
        $dept = $request->validate([
            'd_name'=> ['required', Rule::unique('depts', 'd_name')]
        ]);

        $dept['d_name'] = strtoupper($dept['d_name']);

        Dept::create($dept);

        return redirect()->back()->with('success', 'Dept has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function show(Dept $dept)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function edit(Dept $dept)
    {
        
        return view('depts.edit', compact('dept'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dept $dept)
    {
        

        $newDept = $request->validate([
            'd_name'=>['required']
        ]);

        $newDept['d_active'] = $request->has('d_active');

        $dept->update($newDept);

        

        return redirect()->back()->with('success', 'Dept has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dept $dept)
    {
        //
    }
}
