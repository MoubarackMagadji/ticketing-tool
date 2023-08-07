@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('status.create') }}'><button>Create a status</button></a>
    
    @forelse ($statuss as $status)
        
        
        <div class='border-bottom py-3' >
            <span>{{ $status->name }} </span>

            <span> {{ $status->status }}</span>
            <a href= {{ route('status.edit', $status->id ) }} ><button>Edit</button></a>
        </div>
    @empty
        <div class='my-3'>{{ 'No depts for now' }}</div>
    @endforelse

@endsection