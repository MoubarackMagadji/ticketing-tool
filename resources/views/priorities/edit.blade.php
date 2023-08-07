@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('priorities') }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>
    
    <form action=" {{ route('priority.update', $priority->id)}} " method='post' class='w-50 mt-5'>

        @csrf

        <div class='mb-3'>
            <label class='form-label' for="code">Priority code</label>
            <input class='form-control' type="text" name='code' id='code' value="{{ $priority->code }}" disabled>

        </div>

        <div class='mb-3'>
            <label class='form-label' for="name">Priority name</label>
            <input class='form-control' type="text" name='name' id='name' value="{{ old('name', $priority->name)}}" required>

            @error('name')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <div class='mb-3'>
            <label class='form-label' for="sla">Priority SLA</label>
            <input class='form-control' type="number" name='sla' id='sla' value="{{ old('sla', $priority->sla)}}" required>

            @error('sla')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name='status'  id="status" {{ $priority->status ? 'checked':'' }}>
            <label class="form-check-label" for="status">
                Active 
            </label>
        </div>

        <input type="submit" class='btn btn-primary btn-sm'>
    </form>

@endsection