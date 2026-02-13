@extends('layouts.app')

@section('content')

@include('dashboard.partials.common')

@if(auth()->user()->role === 0)
@include('dashboard.partials.admin')
@endif

@endsection