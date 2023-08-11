<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Ticket $ticket)
    {
        
        $fileString = '';
        if($request->has('filesattached')){
            foreach($request->file('filesattached') as $file){
                $fileName = uniqid().'_'.$file->getClientOriginalName();
                
                Storage::putFileAs('public/filesAttached/', $file, $fileName);
                $fileString = $fileString.$fileName.'#';
            }
        }

        $data = $request->validate([
            'commenttext' => ['nullable']
        ]);

        $commentData['user_id'] = auth()->user()->id;
        $commentData['ticket_id'] = $ticket->id;
        $commentData['commemttext'] = $request->commenttext;
        $commentData['filesattached'] = $fileString;

        Comment::create($commentData);

        return redirect()->route('ticket.show', $ticket->id )->with('success','Comment added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
