@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('dept.create') }}'><button>Create a department</button></a>
    
    @forelse ($depts as $dept)
        
        
        <div class='border-bottom py-3' >
            <span>{{ $dept->d_name }} </span>

            <span> {{ $dept->status }}</span>
            <a href= {{ route('dept.edit', $dept->id ) }} ><button>Edit</button></a>
        </div>
    @empty
        {{ 'No depts for now' }}
    @endforelse

@endsection