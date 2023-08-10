@extends('layouts.mainlayout')

@section('css')
    <link rel="stylesheet" href=" {{ asset('css/select2.min.css')}}"> 
@endsection

@section('content')

    <a href=' {{ route('priorities') }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>
    
    <form action=" {{ route('category.update', $category->id)}} " method='post' class='w-50 mt-5'>

        @csrf

        

        <div class='mb-3'>
            <label class='form-label' for="name">Priority name</label>
            <input class='form-control' type="text" name='name' id='name' value="{{ old('name', $category->name)}}" required>

            @error('name')
                <span class='text-danger'>{{ $message }}</span>
            @endError
        </div>

        {{-- {{ dd($category->depts->pluck('id')->toArray()) }} --}}

        <div class='mb-3'>
            <select class='form-select' name="depts[]" id='depts' multiple='true'>
                @foreach ($depts as $dept)
                    <option value="{{ $dept->id }}"  {{ $category->hasDept($dept->id)  ? 'selected':'' }}> {{ $dept->d_name }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name='status'  id="status" {{ $category->status ? 'checked':'' }}>
            <label class="form-check-label" for="status">
                Active 
            </label>
        </div>



        <input type="submit" class='btn btn-primary btn-sm'>
    </form>

@endsection

@section('js')
    <script src=" {{ asset('js/select2.min.js')}}"> </script>
@endsection

@section('script')
    <script>
        
        $(document).ready(()=>{
            
            $("#depts").select2({
                tags: true,
                placeholder: "Select a category",
            });

        })

        

        $("#depts").hide()
    </script>
@endsection