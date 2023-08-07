@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('user.show', $user->id) }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    
    <form action=" {{ route('user.update', $user->id)}} " method='post' class='w-50 mt-5'>

        @csrf

        <div class='mb-3'>
            <label class='form-label' for="name">Name</label>
            <input class='form-control' type="text" name='name' id='name'  value=" {{ old('name', $user->name) }}">

            @error('d_name')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <div class='mb-3'>
            <label class='form-label' for="email">Email</label>
            <input class='form-control' type="email" name='email' id='email' value=" {{ old('email', $user->email) }}">

            @error('email')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <div class='mb-3'>
            <label class='form-label' for="staffID">Staff ID</label>
            <input class='form-control' type="text" name='staffID' id='staffID' value=" {{ old('staffID', $user->staffID) }}">

            @error('staffID')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        

        <div class='mb-3'>
            <label class='form-label' for="">Dept </label>

            <select class='form-select' name='dept_id' >
                <option value=''>Choose dept</option>

                @foreach ($depts as $dept)
                    <option value="{{ $dept->id }}"  {{ old('dept_id', $user->dept_id) == $dept->id ? 'selected' : '' }}> {{ $dept->d_name }}</option>
                @endforeach
            </select>
            

            @error('dept_id')
                <span class='text-danger'>{{ $message }}</span>
            @endError

        </div>

        <div class='mb-3'>
            <label class='form-label' for="">Level </label>

            <select class='form-select' name='level' >
                <option {{ old('level', $user->level) == 1 ? 'selected' : '' }}>1</option>
                <option {{ old('level', $user->level) == 2 ? 'selected' : '' }}>2</option>
                <option {{ old('level', $user->level) == 3 ? 'selected' : '' }}>3</option>
                <option {{ old('level', $user->level) == 4 ? 'selected' : '' }}>4</option>
                <option {{ old('level', $user->level) == 5 ? 'selected' : '' }}>5</option>
            </select>
            

            @error('level')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <div class='mb-3'>
            <label class='form-label' for="username">Username</label>
            <input class='form-control' type="text" name='username' id='username' 
                value=" {{ old('username', $user->username) }}">

            @error('username')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name='status'  id="status" {{ $user->status ? 'checked':'' }}>
            <label class="form-check-label" for="status">
                Active
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name='isadmin'  id="isadmin" {{ $user->isadmin ? 'checked':'' }}>
            <label class="form-check-label" for="isadmin">
                Is Admin
            </label>
        </div>

        <input type="submit" class='btn btn-primary btn-sm'>


    </form>



    {{-- <div class='mb-3'>
            <label class='form-label' for="password">Password</label>
            <input class='form-control' type="password" name='password' id='password' >

            @error('password')
                <span class='text-danger'>{{ $message }}</span>
            @endError
    </div>

    <div class='mb-3'>
        <label class='form-label' for="password_confirmation">Password confirmation</label>
        <input class='form-control' type="password" name='password_confirmation' id='password_confirmation' >

        @error('password_confirmation')
            <span class='text-danger'>{{ $message }}</span>
        @endError
    </div> --}}

@endsection