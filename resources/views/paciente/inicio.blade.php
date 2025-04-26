@extends('layouts.app')

@section('title', 'Home Paciente')

@section('navbar')
    @include('partials.navbar-paciente')
@endsection

@section('content')
    @include('partials.home-content')
@endsection
