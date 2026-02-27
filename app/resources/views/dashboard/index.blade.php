@extends('layouts.app')

@section('content')

@if(auth()->user()->isAdmin())
    @include('dashboard.admin')
@else
    @include('dashboard.general')
@endif

@endsection