@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('status') }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>
    
    <form action=" {{ route('status.update', $status->id )}} " method='post' class='w-50 mt-5'>

        @csrf

        <div class='mb-3'>
            <label class='form-label' for="name">Status name</label>
            <input class='form-control' type="text" name='name' id='name' value="{{$status->code }}" disabled required>

            
        </div>

        <div class='mb-3'>
            <label class='form-label' for="name">Status name</label>
            <input class='form-control' type="text" name='name' id='name' value="{{old('name', $status->name) }}" required>

            @error('name')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name='status'  id="status" {{ $status->status ? 'checked':'' }}>
            <label class="form-check-label" for="status">
                Active 
            </label>
        </div>

        <input type="submit" class='btn btn-primary btn-sm'>
    </form>

@endsection