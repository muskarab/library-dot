@extends('layouts.base')

@section('body')
    <x-navbar></x-navbar>
    <div class="container mx-auto mt-10 mb-10">
        @yield('content')
    </div>
@endsection