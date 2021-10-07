@extends('layouts.backend')
@section('content')

<div class="col-lg-12 margin-tb">

    <h2>Create Book</h2>

    <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
            @error('title')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <select name="author" id="author" class="form-control" required>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
            @error('image')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            {{-- <textarea name="content" id="content" class="form-control" rows="5" required></textarea> --}}
            <input id="content" type="hidden" name="content">
            <trix-editor input="content"></trix-editor>
            @error('content')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="page">Page</label>
            <input type="number" name="page" id="page" class="form-control" required>
                @error('page')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('book.index') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection