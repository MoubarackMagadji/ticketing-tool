@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('user.edit', $user->id) }}'><button>Edit this user</button></a>
    
    {{ $user->staffID }} - {{ $user->name }}

@endsection