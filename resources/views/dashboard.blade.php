@extends('layouts.mainlayout')

@section('content')
    
    {{ Auth::user()->name }}

@endsection