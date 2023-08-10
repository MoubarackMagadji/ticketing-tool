@extends('layouts.mainlayout')



@section('title')
    {{ $ticket->title }}
@endsection



@section('content')
    
    <h1 class="display-6"> Ticket No: {{ $ticket->id }} - <span>{{ $ticket->title }} </span> </h1>

    <div class='row'>

        <div class='col-4'>
           
            <div class='row'>
                <div class='col mb-3'>
                    <label class='form-label' for="">Priority </label>
        
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
                    <label class='form-label' for="">Status </label>
        
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
                    <a href=' {{ route('changecategories', ['ticket'=>$ticket->id]) }}'>
                    <button>Change</button></a> </span>
                <span class='d-block fw-bold'>{{ $ticket->category->name }}</span>
            </div>

            <div>
                <span class='d-block '>Subategory</span>
                <span class='d-block fw-bold'>{{ $ticket->subcategory->name }}</span>
            </div>

            <div>
                <span class='d-block '>Description</span>
                <span class='d-block fw-bold'>{{ $ticket->description }}</span>
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

        <div class='col-8'>
            Comments
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