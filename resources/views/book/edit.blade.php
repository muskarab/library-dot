@extends('layouts.backend')
@section('content')

<div class="col-lg-12 margin-tb">

    <h2>Edit Book</h2>

    <form action="{{ route('book.update', $book->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}">
            @error('title')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <select name="author" id="author" class="form-control" required>
                @foreach ($authors as $author)
                    @if ($book->author_id == $author->id)
                        <option selected value="{{ $author->id }}">(selected) {{ $author->name }}</option>
                    @else
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endif
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
            {{-- <textarea name="content" id="content" class="form-control" rows="5">{{ $book->content }}</textarea> --}}
            <input id="content" type="hidden" name="content" value="{{ $book->content }}">
            <trix-editor input="content"></trix-editor>
            @error('content')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="page">Page</label>
            <input type="number" name="page" id="page" class="form-control"  value="{{ $book->page }}">
                @error('page')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('book.index') }}" class="btn btn-primary">Back</a>
    </form>
</div>
@endsection