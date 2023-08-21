@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('ticket.show', $ticket->id ) }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>
    
    <div class="bg-white p-2 mt-2">
        {{ $ticket->id }}
    </div>

    

    <div class="bg-white p-2 mt-2">
        {{-- {{ $ticket->adept->users }} --}}
        <form action='{{ route('usersonticketviewadd', $ticket->id)}}' method='post'>
            @csrf
            <label class="form-label">Select User to be on ticket</label>
            <select class='form-select' name="assignees[]" id ='assignee' multiple='true'>
                @foreach ($ticket->adept->users->whereNotIn('id', $ticket->usersonit->pluck('id')->toArray()) as $user)
                    
                    <option value="{{ $user->id}}" > {{ $user->name }} </option>
                    
                @endforeach
            </select>
            <button class='btn btn-primary btn-sm'>Assign</button>
        </form>
    </div>


    <div class="bg-white p-3 mt-2">
        <h3 class="display-6">List of users on the ticket</h3>

        

        @foreach ($ticket->usersonit as $user)

            <div>
                <div class='d-flex mb-3'> 
                    <span> {{ $user->name }}  </span>
                    
                    <div class='ms-auto d-flex'>
                        @if ( !$user->pivot->ismain) 
                            <form action='{{ route('usersonticketviewmakemain', $ticket->id) }}' method='post' class='ms-2'>
                                @csrf
                                <input type='hidden' name='user_id' value="{{ $user->id }}">
                                <button class='btn btn-sm btn-primary'> Make main</button>
                            </form>
                        @endif
                        
                        @if ($user->pivot->status)
                            <form action='{{ route('usersonticketviewdeactivate', $ticket->id) }}' method='post' class='ms-2'>
                                @csrf
                                <input type='hidden' name='user_id' value="{{ $user->id }}">
                                <button class='btn btn-sm btn-danger'> Deactivate</button>
                            </form>
                        @else
                            <form action='{{ route('usersonticketviewactivate', $ticket->id) }}' method='post' class='ms-2'>
                                @csrf
                                <input type='hidden' name='user_id' value="{{ $user->id }}">
                                <button class='btn btn-sm btn-info'> Activate</button>
                            </form>
                        @endif
                    </div>
                    
                    
            </div>

        @endforeach
    </div>


    
    

@endsection

