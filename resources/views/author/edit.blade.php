@extends('layouts.backend')
@section('content')

<div class="col-lg-12 margin-tb">

    <h2>Update Author</h2>

    <form action="{{ route('author.update', $author->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $author->name }}">
            @error('name')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('author.index') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection