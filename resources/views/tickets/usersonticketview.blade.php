@extends('layouts.mainlayout')


@section('content')

    <a href=' {{ url()->previous() }}'><button class='btn btn-light btn-sm px-4'>Back</button></a>
    
    

@endsection

