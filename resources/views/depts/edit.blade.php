@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('depts') }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>
    
    <form action=" {{ route('dept.update', $dept->id)}} " method='post' class='w-50 mt-5'>

        @csrf
        @method('PUT')

        <div class='mb-3'>
            <label class='form-label' for="d_name">Dept name</label>
            <input class='form-control' type="text" name='d_name' id='d_name' value="{{ old('d_name', $dept->d_name)}}" required>

            @error('d_name')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>
        
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name='d_active'  id="activeCheck" {{ $dept->d_active ? 'checked':'' }}>
            <label class="form-check-label" for="activeCheck">
                Active
            </label>
        </div>

        <input type="submit" class='btn btn-primary btn-sm'>
    </form>

@endsection