@extends('layouts.index')
@section('title', 'dashboard')
@section('content')
    Dashboard
    {{ Auth::user()->roles }}
@endsection
