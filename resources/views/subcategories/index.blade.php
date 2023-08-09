@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('subcategory.create') }}'><button>Create a subcategory</button></a>
    
    @forelse ($subcategories as $subcategory)
        
        
        <div class='border-bottom py-3' >
            <span>{{ $subcategory->name }} </span>
            <span> {{ $subcategory->category->name }}</span>
            <span> {{ $subcategory->status_word }}</span>

            <a href= {{ route('subcategory.edit', $subcategory->id ) }} ><button>Edit</button></a>
        </div>
    @empty
        <div class='my-3'>{{ 'No subcategory for now' }}</div>
    @endforelse

@endsection