@extends('layouts.mainlayout')

@section('css')
    <link rel="stylesheet" href={{ asset('css/vanillaSelectBox.css') }}>
@endsection

@section('title')
    Users
@endsection

@section('content')

    <a class='mb-5 d-inline-block' href=' {{ route('user.create') }}'><button class='btn btn-primary btn-sm'>Create a user</button></a>

    <div>
        <form action=" {{ route('users') }}" method="post" class='d-flex mb-5 flex-wrap'>

            @csrf

            <div>
                <label for="">User ID</label>
                <input type="text" class='form-control' name='staffId' placeholder="User ID" value='{{ $request->staffId }}'>
            </div>
            <div class='ms-1'>
                <label for="">Depts</label>
                <select name='dept_id' class='form-control' id='dept_id' >
                    <option value=''>All depts</option>
                    @foreach ($depts as $dept)
                        <option value="{{ $dept->id}}" {{ $request->dept_id == $dept->id ? 'selected' : '' }}> {{ $dept->d_name }} </option>
                    @endforeach
                </select>
            </div>

            <div class='ms-1'>
                <label for="">Status {{ $request->status_id }} </label>
                <select name='status_id' class='form-select'>
                    <option value=''  >All statuses</option>
                    <option value="1" {{ $request->status_id == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $request->status_id == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <input type="submit" class='btn btn-sm btn-primary mt-auto ms-2 px-3' style="height: 36px">
           
        </form>
    </div>
    
    <table id='table' class='table table-hover table-bordered  table-sm table-condensed'>
        <thead class=''>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </thead>  
        <tbody>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->staffID }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                    <td><a  href= {{ route('user.show', $user->id ) }} ><button class='btn btn-outline-primary btn-sm'>View</button></a></td>
                    
                </tr>
            @endforeach
            
        </tbody>
    </table>  

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

            let mySelect = new vanillaSelectBox("#dept_id",{
                // search: true,
                maxWidth: 200,
                minWidth: -1,
                placeHolder: "All depts"
            }); 

        })

        

        
    </script>
@endsection