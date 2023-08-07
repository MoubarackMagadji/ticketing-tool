<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priorities = Priority::all();

        return view('priorities.index')->with('priorities', $priorities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('priorities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $priorityData = $request->validate([
            'name' => ['required','min:3', Rule::unique('priorities', 'name')],
            'sla' => 'required|integer'
        ]);

        $priorityData['code'] = Str::slug($priorityData['name']);

        Priority::create($priorityData);

        return redirect()->back()->with('success', 'Priority has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function show(Priority $priority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function edit(Priority $priority)
    {
        return view('priorities.edit', compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Priority $priority)
    {
        $priorityData = $request->validate([
            'name' => ['required','min:3', Rule::unique('priorities', 'name')->ignore($priority)],
            'sla' => 'required|integer'
        ]);

        $priority['status'] = $request->has('status') ? 1 : 0;
        $priority['name'] = $request['name'];
        $priority['sla'] = $request['sla'];
        
        $priority->save();

        return redirect()->back()->with('success', 'Priority updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function destroy(Priority $priority)
    {
        //
    }
}
