@extends('layouts.mainlayout')

@section('content')

    <a href=' {{ route('ticket.create') }}'><button>Create a ticket</button></a>
    
    @forelse ($tickets as $ticket)
        
        
        <div class='border-bottom py-3 row' >
            <span class='col'>{{ Str::limit($ticket->title,30) }} </span>
            <span class='col'> {{ $ticket->rdept->d_name }}</span>
            <span class='col'> {{ $ticket->ruser->name }}</span>
            <span class='col'> {{ $ticket->category->name }}</span>
            <span class='col'> {{ $ticket->created_at->format('d-m h:i') }}</span>
            <span class='col'> {{ $ticket->adept->d_name }}</span>
            <span class='col'> {{ $ticket->luser->name }}</span>
             
            <span class='col'>
                <a href= {{ route('ticket.show', $ticket->id ) }} ><button>View</button></a>
            </span>
        </div>
    @empty
        <div class='my-3'>{{ 'No tickets for now' }}</div>
    @endforelse

@endsection