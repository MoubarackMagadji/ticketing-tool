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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        // dd($request->all());

        // dd($request->has('attachement'));
        $fileString = '';
        if($request->has('attachement')){
            // dd( $request->attachement);
            foreach($request->file('attachement') as $file){
                $fileName = uniqid().'_'.$file->getClientOriginalName();
                Storage::putFileAs('public/attachements/', $file, $fileName);
                $fileString = $fileString.$fileName.'#';
            }
        }
        

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
            'attachedFiles' => $fileString
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

    public function changestatuspriority(Request $request, Ticket $ticket){
        // dd($request);

        $data = $request->validate([
            'priority_id' => ['nullable', 'integer', Rule::exists('priorities', 'id')],
            'status_id' => ['nullable', 'integer', Rule::exists('statuses', 'id')],
        ]);

        $ticket['priority_id'] = $request->priority_id;
        $ticket['status_id'] = $request->status_id;

        $ticket->save();

        return redirect()->route('ticket.show', $ticket->id )->with('success','Changed successfully made');

    }

    public function usersonticketview(Ticket $ticket){

        return view('tickets.usersonticketview', compact('ticket'));

    }

    public function usersonticketviewadd(Ticket $ticket, Request $request){
        // dd($ticket->toArray());

        $ticket->usersonit()->Attach($request->assignees);

        return redirect()->back()->with('success','Users assigned');
    }

    public function usersonticketviewmakemain(Request $request, Ticket $ticket){
        
        DB::table('staffs_on_ticket')->whereticket_id($ticket->id)->whereismain(true)
            ->update([
                'ismain' => false,
                'updated_at' =>now()
            ]);
        

        DB::table('staffs_on_ticket')->whereticket_id($ticket->id)->whereuser_id($request->user_id)
            ->update([
                'ismain' => true,
                'updated_at' =>now()
            ]);
        

        return redirect()->back()->with('success','Main user edited');
    }

    public function usersonticketviewdeactivate(Ticket $ticket, Request $request){
        DB::table('staffs_on_ticket')->whereticket_id($ticket->id)->whereuser_id($request->user_id)
            ->update([
                'status' => false,
                'updated_at' =>now()
            ]);
          
            return redirect()->back()->with('success','user deactivated');
    }

    public function usersonticketviewactivate(Ticket $ticket, Request $request){
        DB::table('staffs_on_ticket')->whereticket_id($ticket->id)->whereuser_id($request->user_id)
            ->update([
                'status' => true,
                'updated_at' =>now()
            ]);
          
            return redirect()->back()->with('success','user activated');
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
