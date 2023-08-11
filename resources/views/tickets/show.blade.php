@extends('layouts.mainlayout')



@section('title')
    {{ $ticket->title }}
@endsection



@section('content')
<div class='' >  
    <h1 class="display-6"> Ticket No: {{ $ticket->id }} - <span>{{ $ticket->title }} </span> </h1>

    <div class='ms-2 row gap-2'>

        <div class='col-3 me-4 p-2 border border-secondary bg-white' >
           
            <div >
                <form method='post' action=" {{ route('ticket.changestatuspriority', ['ticket'=>$ticket->id])}}" 
                    class='row'>

                    @csrf

                    <div class='col mb-3'>
                        {{-- <label class='form-label' for="">Priority </label> --}}
            
                        <select class='form-select' name='priority_id' >
                            <option value=''>Choose a priority</option>
            
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority->id }}"
                                    {{ $priority->id == $ticket->priority_id ? 'selected' : '' }}> 
                                    {{ $priority->name }}
                                </option>
                            @endforeach
            
                            
                        </select>

                    </div>

                    <div class='col mb-3'>
                        {{-- <label class='form-label' for="">Status </label> --}}
            
                        <select class='form-select' name='status_id' >
                            <option value=''>Choose a status</option>
            
                            @foreach ($statuss as $status)
                                <option value="{{ $status->id }}"
                                    {{ $status->id == $ticket->status_id ? 'selected' : '' }}> 
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        
            
                        @error('status_id')
                            <span class='text-danger'>{{ $message }}</span>
                        @endError
            
                    </div>
                    <div class='col-1 justify-self-bottom'>
                        <button class='btn btn-secondary'>OK</button>
                    </div>
                </form>
                
            </div>

            <div>
                <span class='d-block '>Created At:</span>
                <span class='d-block fw-bold'>{{ $ticket->created_at->format('d M y, h:i') }}</span>
            </div>

            <div>
                <span class='d-block '>Last Updated at:</span>
                <span class='d-block fw-bold'>{{ $ticket->updated_at->format('d M y, h:i') }}</span>
            </div>

            <div>
                <span class='d-block '>Ticket's logger:</span>
                <span class='d-block fw-bold'>{{ $ticket->luser->name }}</span>
            </div>

            <div>
                <span class='d-block '>Requester Department:</span>
                <span class='d-block fw-bold'>{{ $ticket->rdept->d_name }}</span>
            </div>

            <div>
                <span class='d-block '>Requester Name:</span>
                <span class='d-block fw-bold'>{{ $ticket->ruser->name }}</span>
            </div>

            <div>
                <span class='d-block '>Category 
                    <a href=' {{ route('ticket.changecategories', ['ticket'=>$ticket->id]) }}'>
                    <button>Change</button></a> </span>
                <span class='d-block fw-bold'>{{ $ticket->category->name }}</span>
            </div>

            <div>
                <span class='d-block '>Subategory</span>
                <span class='d-block fw-bold'>{{ $ticket->subcategory->name }}</span>
            </div>

            <div>
                <span class='d-block '>Description</span>
                <span class='d-block fw-bold'>{!! $ticket->description !!}</span>
            </div>

            <div>
                0 files attached
            </div>

            {{-- <div class='mb-3'>
                <label class='form-label' for="">Subategory </label>

                <select class='form-select' name='subcategory_id' >
                    <option value=''>Choose Subategory</option>

                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}"
                            {{ $subcategory->id == old('subcategory_id') ? 'selected' : '' }}> 
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </select>
                

                @error('subcategory_id')
                    <span class='text-danger'>{{ $message }}</span>
                @endError

            </div> --}}

        

        </div>

        <div class='col-8 d-flex flex-column'>
            
            <h5 class='m-0 p-0'>Comments count: {{ $ticket->comments->count() }}</h5>
            
            <div class='border border-secondary flex-fill'>
                {{-- {{ $ticket->comments }} --}}
                @forelse ($ticket->comments as $comment)
                    <div class='bg-white p-2 mb-2'>
                        <div class='d-flex justify-content-between fw-bold' style="border-bottom:1px dashed black">
                            <span>{{ $comment->user->name }}</span>
                            <span>{{ $comment->created_at->format('d-m-y h:i:s') }} </span>
                        </div>
                        <div>
                            {{ $comment->commemttext }}  
                        </div>
                        <div>
                            {{ $comment->hasFile }}
                        </div>
                    </div>
                @empty
                    No comment for this ticket
                @endforelse
            </div>

            <form class='mt-2' action='{{ route('commentpost', $ticket->id) }}' method='post' enctype="multipart/form-data">
                @csrf
                <textarea class="form-control rounded-0" name='commenttext' placeholder='Add a comment' rows='4'></textarea>
                <div class='d-flex justify-content-between mt-1'>
                    <input type='file' id='filesattached'  name='filesattached[]' multiple='true' >
                    {{-- <label for='filesAttached'><span>Select files</span></label> --}}
                    <button class='btn btn-sm btn-primary'>Send</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@section('csscode')
    <style>
        .row{
            width: 100%;
        }
    </style>
@endsection