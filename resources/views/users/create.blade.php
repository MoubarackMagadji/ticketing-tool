@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('depts') }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    
    <form action=" {{ route('user.store')}} " method='post' class='w-50 mt-5'>

        @csrf

        <div class='mb-3'>
            <label class='form-label' for="d_name">Name</label>
            <input class='form-control' type="text" name='d_name' id='d_name' required>

            @error('d_name')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <input type="submit" class='btn btn-primary btn-sm'>
    </form>

@endsection