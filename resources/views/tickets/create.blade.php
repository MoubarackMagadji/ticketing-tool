@extends('layouts.mainlayout')

@section('css')
    {{-- <link rel="stylesheet" href=" {{ asset('css/bootstrap-select.min.css')}}">  --}}
@endsection


@section('title')
    Create ticket
@endsection


@section('content')

    <a href=' {{ route('tickets') }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>
    
    <form action=" {{ route('ticket.store')}} " method='post' class='w-50 mt-5' enctype="multipart/form-data">

        @csrf

        <div class='mb-3'>
            <label class='form-label' for="title">Ticket title</label>
            <input class='form-control' type="text" name='title' id='title' value="{{ old('title')}}" required>

            @error('title')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <div class='mb-3'>
            <label class='form-label' for="">Requester dept </label>

            <select class='form-select' name='requester_dept_id' >
                <option value=''>Choose a dept</option>

                @foreach ($depts as $dept)
                    <option value="{{ $dept->id }}" 
                        {{ $dept->id == old('requester_dept_id') ? 'selected' : '' }}> 
                        {{ $dept->d_name }}</option>
                @endforeach
            </select>
            

            @error('requester_dept_id')
                <span class='text-danger'>{{ $message }}</span>
            @endError

        </div>

        <div class='mb-3'>
            <label class='form-label' for="">Requester name </label>

            <select class='form-select' name='requester_user_id' >
                <option value=''>Choose a user</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        {{ $user->id == old('requester_user_id') ? 'selected' : '' }}> 
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            

            @error('requester_user_id')
                <span class='text-danger'>{{ $message }}</span>
            @endError

        </div>



        <div class='mb-3'>
            <label class='form-label' for="">Category </label>

            <select class='form-select' name='category_id' >
                <option value=''>Choose Category</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == old('category_id') ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            

            @error('category_id')
                <span class='text-danger'>{{ $message }}</span>
            @endError

        </div>

        <div class='mb-3'>
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

        </div>

        <div class='mb-3'>
            <label class='form-label' for="">Priority </label>

            <select class='form-select' name='priority_id' >
                <option value=''>Choose a priority</option>

                @foreach ($priorities as $priority)
                    <option value="{{ $priority->id }}"
                        {{ $priority->id == old('priority_id') ? 'selected' : '' }}> 
                        {{ $priority->name }}
                    </option>
                @endforeach

                
            </select>
            

            @error('priority_id')
                <span class='text-danger'>{{ $message }}</span>
            @endError

        </div>

        <div class='mb-3'>
            <label class='form-label' for="">Status </label>

            <select class='form-select' name='status_id' >
                <option value=''>Choose a status</option>

                @foreach ($statuss as $status)
                    <option value="{{ $status->id }}"
                        {{ $status->id == old('status_id') ? 'selected' : '' }}> 
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
            

            @error('status_id')
                <span class='text-danger'>{{ $message }}</span>
            @endError

        </div>

        <div class='mb-3'>
            <label class='form-label' for="description">Ticket description</label>
            <textarea class='form-control' name="description" id="description" placeholder="Describe the problem here"> {{ old('description') }} </textarea>

            @error('description')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <div class='mb-3'>
            <label class='form-label' for="attachement">Attachement</label>
            <input class='form-control' type='file' name="attachement[]" multiple id="attachement" >

            @error('attachement')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>
        
        <input type="submit" class='btn btn-primary btn-sm mt-3' value='Create ticket'>
    </form>

@endsection


@section('js')
    {{-- <link rel="stylesheet" href=" {{ asset('js/bootstrap-select.min.js')}}">  --}}
@endsection

@section('script')
    <script>
        $(document).ready(()=>{
            
            /* console.log('ok')
            let data = {
                "_token": "{{ csrf_token() }}",
                'tic':'touctouc'
            }
            
            
            $.ajax({
                url:" {{ route('loadsubcategories') }}",
                method:'post',
                data:data,
                dataType:'text',
                success: function(donne){
                   console.log(donne)
                }
                    
            }) */
            
        })
    </script>
@endsection