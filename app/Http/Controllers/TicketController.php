<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use App\Models\User;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\CreateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view ('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $depts = Dept::all()->where('d_active',1);
        $categories = Category::all()->where('status',1);
        $subcategories = Subcategory::all()->where('status',1);
        $users = User::all()->where('status',1);
        $priorities = Priority::all()->where('status',1);
        $statuss = Status::all()->where('status',1);

        
        return view('tickets.create', compact('categories', 'subcategories', 'depts', 'users', 'priorities', 'statuss'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTicketRequest $request)
    {
        
        $ticketDetails = [
            'title' => $request->title,
            'rdept_id' => $request->requester_dept_id,
            'ruser_id' => $request->requester_user_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'description' => $request->description,
            'status_id' => $request->status_id ?? 1,
            'priority_id' => $request->priority_id ?? 1,
            'dept_id' => auth()->user()->dept_id,
            'user_id' => auth()->user()->id,
        ];

        Ticket::create($ticketDetails);
        
        return redirect()->back()->with('success','Ticket created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $categories = Category::all()->where('status',1);
        $subcategories = Subcategory::all()->where('status',1);
        $priorities = Priority::all()->where('status',1);
        $statuss = Status::all()->where('status',1);

        return view('tickets.show',compact('ticket', 'categories', 'subcategories', 'priorities', 'statuss'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    public function changecategories(Ticket $ticket){
        // dd($ticket);

        $categories = Category::all()->where('status',1);
        $subcategories = Subcategory::all()->where('status',1);

        return view('tickets.changecategories', compact('categories','subcategories', 'ticket'));
    }

    public function changecategoriespost(Request $request,Ticket $ticket){
        // dd($ticket);

        $data = $request->validate([
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'subcategory_id' => ['required', 'integer', Rule::exists('subcategories', 'id')],
        ]);

        $ticket['category_id'] = $request->category_id;
        $ticket['subcategory_id'] = $request->subcategory_id;

        $ticket->save();

        return redirect()->route('ticket.show', $ticket->id )->with('success','Categories successfully changed');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
