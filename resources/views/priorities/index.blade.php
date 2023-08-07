@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('priority.create') }}'><button>Create a priority</button></a>
    
    @forelse ($priorities as $priority)
        
        
        <div class='border-bottom py-3' >
            <span>{{ $priority->name }} </span>

            <span> {{ $priority->status_word }}</span>

            <a href= {{ route('priority.edit', $priority->id ) }} ><button>Edit</button></a>
        </div>
    @empty
        <div class='my-3'>{{ 'No Priority for now' }}</div>
    @endforelse

@endsection