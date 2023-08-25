@extends('layouts.mainlayout')

@section('css')
    <link rel="stylesheet" href={{ asset('css/vanillaSelectBox.css') }}>
@endsection


@section('content')

    <a href=' {{ route('ticket.create') }}'><button  class='btn btn-primary btn-sm px-3'>Create a ticket</button></a>

    <div>
        <form action=" {{ route('tickets') }}" method="post" class='d-flex mt-3 mb-5 flex-wrap'>

            @csrf

            <div>
                <label for="">Ticket ID</label>
                <input type="search" class='form-control' name='id' placeholder="Ticket ID" value='{{ $request->id }}'>
            </div>
            <div>
                <label for="">Ticket title</label>
                <input type="text" class='form-control' name='title' placeholder="Type the ticket title" value='{{ $request->title }}'>
            </div>

            <div> 
                <label  for="">Status  </label>
                <select class='form-select' name='status[]' id='status'  multiple size='2'>
                    @foreach ($statuss as $status)
                        <option value="{{ $status->id }}"

                            {{ (session('status') && in_array($status->id, session('status'))) ? 'selected' : '' }}
                           
                            > 
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div> 
                <label  for="">Priorities  </label>
                <select class='form-select' name='priorities[]' id='priority'  multiple size='2'>
                    @foreach ($priorities as $priority)
                        <option value="{{ $priority->id }}"

                            {{ (session('priorities') && in_array($priority->id, session('priorities'))) ? 'selected' : '' }}
                           
                            > 
                            {{ $priority->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="">Assign user</label>
                <input type="search" class='form-control' name='user' placeholder="Type the name" value='{{ $request->user }}'>
            </div>

            <div class='text-center'>
                <label  for="">Created date</label>
                <div class='d-flex'>
                    {{-- {{ $request->startTime }} --}}
                    <input type="date" class='form-control' name='startTime' value="{{ $request->startTime }}">
                    <input type="date" class='form-control' name='endTime' value="{{ $request->endTime }}">
                </div>
            </div>
            
            <input type="submit" class='btn btn-sm btn-primary mt-auto ms-2 px-3' style="height: 36px">

        </form>
    </div>

    
    <table id='table' class='table table-hover table-bordered  table-sm table-condensed'>
        <thead class=''>
            <th>ID</th>
            <th>Title</th>
            <th>Req Dept</th>
            <th>Req user</th>
            <th>Subcategory</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Time</th>
            {{-- <th>Ass dept</th> --}}
            <th>main user</th>
            <th>Actions</th>
        </thead>  
        <tbody>

            @foreach($tickets as $ticket)
                
                <tr>
                   <td> {{ $ticket->id }} </td>
                   <td> {{ Str::limit($ticket->title,30) }} </td>
                   <td> {{ $ticket->rdept->d_name }}</td> 
                   <td> {{ $ticket->ruser->name }}</td>
                   <td> {{ $ticket->subcategory->name }}</td>
                   <td> {{ $ticket->status->name }}</td>
                   <td> {{ $ticket->priority->name }}</td>
                   <td> {{ $ticket->created_at->format('d-m h:i') }}</td>
                   {{-- <td> {{ $ticket->adept->d_name }}</td> --}}
                   <td> 
                        {{ ($ticket->mainuser) ? $ticket->mainuser->name : '' }}
                        
                    </td>
                   <td>
                        <a href= {{ route('ticket.show', $ticket->id ) }} ><button class='btn btn-outline-primary btn-sm'>View</button></a>
                   </td>

                </tr>
           
            @endforeach

@endsection


@section('js')
    <script src=" {{ asset('js/select2.min.js')}}"> </script>
    <script src=" {{ asset('js/vanillaSelectBox.js') }} " ></script>
@endsection

@section('script')
    <script>
        
        $(document).ready(()=>{
            
            var table = $('#table').dataTable({
			
                "lengthMenu": [[50,100,200, -1], [50,100,200, "All"]],
                
            })

            let statusmySelect = new vanillaSelectBox("#status",{
                disableSelectAll: false,
                maxWidth: 200,
                minWidth: -1,
            });

            let prioritymySelect = new vanillaSelectBox("#priority",{
                disableSelectAll: false,
                maxWidth: 200,
                minWidth: -1,
            });

            let usersmySelect = new vanillaSelectBox("#users",{
                disableSelectAll: false,
                maxWidth: 200,
                minWidth: -1,
            });

            $.ajax({
                    url:'postfolder/loading.php',
                    type:'post',
                    data:'departementClickLoading=ok&value='+value,
                    dataType:'json',
                    success: function(donne,statut){
                        valueDiv.empty()
                        donne.forEach(function(dt){
                        $('input[name=t_s_empCode]').siblings('.value')
                        .append($('<span>').attr('data-mvalue',dt['s_empCode']).text(dt['s_fullname']) )
                    })
                        lHide()           
                    }
            })
            
             

        })

        

        
    </script>
@endsection