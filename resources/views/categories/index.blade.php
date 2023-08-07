@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('category.create') }}'><button>Create a category</button></a>
    
    @forelse ($categories as $category)
        
        
        <div class='border-bottom py-3' >
            <span>{{ $category->name }} </span>

            <span> {{ $category->status_word }}</span>

            <a href= {{ route('category.edit', $category->id ) }} ><button>Edit</button></a>
        </div>
    @empty
        <div class='my-3'>{{ 'No category for now' }}</div>
    @endforelse

@endsection