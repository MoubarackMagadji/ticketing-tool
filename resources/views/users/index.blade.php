@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('user.create') }}'><button>Create a user</button></a>
    
    @forelse ($users as $user)

        

        
        
        <div class='border-bottom py-3 row' >
            <span class='col'> {{ $user->staffID }}</span>
            <span class='col'>{{ $user->name }} </span>

            <span class='col'> {{ $user->email }}</span>
            <span class='col'> {{ $user->status ? 'Active' : 'Inactive' }}</span>
            {{-- <span class='col'> {{ $user->username }}</span> --}}
            <a class='col' href= {{ route('user.show', $user->id ) }} ><button>View</button></a>
        </div>
    @empty
        {{ 'No users for now' }}
    @endforelse

@endsection