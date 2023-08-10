@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ url()->previous() }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>
    
    <form action=" {{ route('ticket.changecategoriespost', $ticket->id)}} " method='post' class='w-50 mt-5'>

        @csrf

        <div class='mb-3'>
            <label class='form-label' for="">Category </label>

            <select class='form-select' name='category_id' >
                <option value=''>Choose Category   </option>

                @foreach ($categories as $category)
                    <option 
                        value="{{ $category->id }}" 
                        {{ $category->id == $ticket->category->id ? 'selected' : '' }}> 
                            {{ $category->name }}
                        </option>
                @endforeach
            </select>
            

            @error('dept_id')
                <span class='text-danger'>{{ $message }}</span>
            @endError

        </div>

        <div class='mb-3'>
            <label class='form-label' for="">Subategory </label>

            <select class='form-select' name='subcategory_id' >
                <option value=''>Choose Subategory</option>

                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}"
                        {{ $subcategory->id == $ticket->subcategory_id ? 'selected' : '' }}> 
                        {{ $subcategory->name }}
                    </option>
                @endforeach
            </select>
            

            @error('subcategory_id')
                <span class='text-danger'>{{ $message }}</span>
            @endError

        </div>

        

        

        <input type="submit" class='btn btn-primary btn-sm'>
    </form>

@endsection

