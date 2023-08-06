@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('user.create') }}'><button>Create a user</button></a>
    
    @forelse ($users as $user)

        

        
        
        <div class='border-bottom py-3 row' >
            <span class='col'>{{ $user->name }} </span>

            <span class='col'> {{ $user->email }}</span>
            {{-- <a href= {{ route('dept.edit', $dept->id ) }} ><button>Edit</button></a> --}}
        </div>
    @empty
        {{ 'No users for now' }}
    @endforelse

@endsection