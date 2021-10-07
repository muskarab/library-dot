@extends('layouts.backend')
@section('content')

<div class="col-lg-12 margin-tb">

    <h2>Create Author</h2>

    <form action="{{ route('author.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('author.index') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection