@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ route('subcategories') }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>
    
    <form action=" {{ route('subcategory.store')}} " method='post' class='w-50 mt-5'>

        @csrf

        <div class='mb-3'>
            <label class='form-label' for="name">Subcategory name</label>
            <input class='form-control' type="text" name='name' id='name' required>

            @error('name')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        <div class='mb-3'>
            <label class='form-label' for="">Category </label>

            <select class='form-select' name='category_id' >
                <option value=''>Choose Category</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                @endforeach
            </select>
            

            @error('dept_id')
                <span class='text-danger'>{{ $message }}</span>
            @endError

        </div>

        <input type="submit" class='btn btn-primary btn-sm'>
    </form>

@endsection