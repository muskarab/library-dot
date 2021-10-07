@extends('layouts.base')

@section('body')
    <x-sidebar></x-sidebar>
    <div class="container mx-auto mt-10 mb-10">
        @yield('content')
    </div>
@endsection